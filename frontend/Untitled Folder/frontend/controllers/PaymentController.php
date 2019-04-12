<?php

namespace frontend\controllers;

use Yii;
use Imagine\Filter\Advanced\Border;
use app\models\Payment;
use app\models\Customer;
use app\models\PaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $show_controls = true)
    {
        $model = $this->findModel($id);
        $controls = $show_controls ? $this->renderPartial('_controls', ['id'=>$id]) : null;
        $customer = $this->renderPartial('/customer/_view', ['model' => $model->customer]);
        $invoice_items = Yii::$app->controller->renderPartial('@app/views/invoice-item/_index',[
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->invoice->getInvoiceItems(),
                    'pagination' => false
                    ]),
            ]);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_view', [
                'model' => $model,
                'controls' => $controls,
                'customer' => $customer,
                'invoice_items' => $invoice_items,
            ]);
        } else {
            return $this->render('_view', [
                'model' => $model,
                'controls' => $controls,
                'customer' => $customer,
                'invoice_items' => $invoice_items,
            ]);
        }
    }

    /**
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $payment = new Payment();
        $payment->loadDefaultValues();

        // Also create a new customer
        $customer = new Customer();
        $customer->loadDefaultValues();

        $session = Yii::$app->session;
        $payment->session_id = $session->id;

        if($data = Yii::$app->request->get())
        {
            $invoice_id = $data['invoice_id'];
            $invoice = \app\models\Invoice::find()->where(['id' => $invoice_id])->one();
            $due_amount = $invoice->getInvoiceTotal();
            $order_id = $invoice->order->id;

            $payment->invoice_id = $invoice_id;
            $payment->due = $due_amount;
            $payment->tendered = $due_amount;
        }

        if ($payment->load(Yii::$app->request->post()) && $payment->save())
        {
            // Save customer and save customer_id in session
            $customerSaved = $customer->load(Yii::$app->request->post()) && $customer->save();
            if($customerSaved && $session->isActive){
              $session['customer_id'] = $customer->id;
            }

            // Update product status
            $invoice_items = $invoice->invoiceItems;
            foreach ($invoice_items as $key => $invoice_item) {
              $product_item_id = $invoice_item->product_item_id;
              $product_item = \app\models\ProductItem::find()->where(['id' => $product_item_id])->one();
              $product = $product_item->product;
              $product->product_status = 'ordered';
              $product->save();
            }

            // Close Order
            $order = \app\models\Order::findOne($order_id);
            $order->order_status_id = $order::PAID_ORDER;
            $order->save();

            // Close Invoice
            $invoice->invoice_status_id = $invoice::PAID_INVOICE;
            $invoice->save();

            // End Cart session
            // Remove session variables
            // $session->remove('language');

            // close a session and destroys all data registered to a session.
            $session->close();
            $session->destroy();
            $session->regenerateID(true);

            return $this->redirect(['view', 'id' => $payment->id]);
        } else {
            if (isset($session['customer_id'])){
              $customer_id = $session['customer_id'];
              $payment->customer_id = $customer_id;

              $customer_model = Customer::findOne($customer_id);
              $customer_partial = $this->renderPartial('/customer/_view', ['model' => $customer_model]);

              return $this->render('create-pay', [
                          'payment' => $payment,
                          'customer_partial' => $customer_partial,
              ]);
            }
            return $this->render('create', [
                        'payment' => $payment,
                        'customer' => $customer,
            ]);
        }
    }

    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionReport($id)
    {
        $htmlContent = '';
            // Set page headers
            // $htmlContent .= $this->renderPartial('@app/views/report/_header');
            // get your HTML raw content without any layouts or scripts
        $htmlContent .= Yii::$app->runAction('/payment/view', ['id' => $id, 'show_controls' => false]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');

        $pdf = Yii::$app->pdf;
        $pdf->methods = [ 'SetFooter'=>['Payment|{PAGENO}|{DATE j-F-Y}'],
        ];
        $pdf->content = $htmlContent;
        $pdf->options =  [
                'title' => 'Payment No.: ' . $id,
                'subject' => 'Payment No.: ' . $id,
                'output' => 'payment_' . $id . '.pdf',
                'keywords' => 'payment',
                'author' => 'SKYMOUSE BOOKEEZE!',
                'creator' => 'SKYMOUSE BOOKEEZE!'];
        return $pdf->render();
    }
}
