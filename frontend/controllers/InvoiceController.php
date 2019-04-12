<?php

namespace frontend\controllers;

use Yii;
use app\models\Invoice;
use app\models\InvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller
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
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                        'model' => $model
            ]);
        } else {
            return $this->render('view', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoice();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                        'model' => $model
            ]);
        } else {
            return $this->render('create', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Invoice model.
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
     * Deletes an existing Invoice model.
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
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCheckout($order_id)
    {
        // Open a new session
        $session = Yii::$app->session;
        $invoice_id = 0;

        // check if a session is already open and create an [Invoice] header
        if ($session->isActive && $invoice = Invoice::find()->where(['session_id' => $session->id, 'invoice_status_id' => Invoice::OPEN_INVOICE])->one())
        {
          $invoice_id = $invoice->id;
        } else {
          $session->open();
          $invoice = new Invoice();
          $invoice->loadDefaultValues();
          $invoice->order_id = $order_id;
          $invoice->session_id = $session->id;
          $invoice->save();

          $invoice_id = $invoice->id;
          }

          // Copy from order-items
          $order_items = \app\models\OrderItem::find()->where(['order_id'=> $order_id])->all();
          foreach ($order_items as $key => $value) {
            $invoice_item = new \app\models\InvoiceItem();
            $invoice_item->loadDefaultValues();
            $invoice_item->invoice_id = $invoice_id;
            $invoice_item->product_item_id = $value['product_item_id'];
            $invoice_item->description = $value['description'];
            $invoice_item->quantity = $value['quantity'];
            $invoice_item->unit_cost = $value['unit_cost'];
            $invoice_item->total = $value['total'];
            $invoice_item->save();

            // Change product Status
            \app\models\Product::setProductStatus($value['product_item_id'], 'ordered');

        }

        return $this->redirect(['payment/create', 'invoice_id' => $invoice_id]);
    }
}
