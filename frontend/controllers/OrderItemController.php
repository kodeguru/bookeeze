<?php

namespace frontend\controllers;

use Yii;
use app\models\OrderItem;
use app\models\OrderItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderItemController implements the CRUD actions for OrderItem model.
 */
class OrderItemController extends Controller
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
     * Lists all OrderItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      return $this->redirect(['order/cart']);
    }

    /**
     * Creates a new OrderItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderItem();
        $model->loadDefaultValues();
        // Get or Create Order header
        $order_id = Yii::$app->runAction('order/create');

        // Save order item
        if($data = Yii::$app->request->get())
        {
          $product_id = $data['product_id'];
          $product = \app\models\Product::find()->where(['id' => $product_id])->one();
          $product_item = \app\models\ProductItem::find()->where(['product_id' => $product_id])->one();

          // Calculate days as quantity
          if(isset($product_item->start_date) && isset($product_item->end_date))
          {
            $start_date = $product_item->start_date;
            $end_date = $product_item->end_date;

            $datetime1 = new \DateTime($start_date);
            $datetime2 = new \DateTime($end_date);
            $interval = $datetime1->diff($datetime2);

            // minimum days is 1
            $days = ($interval->days > 0) ? $interval->days : 1;
            $model->quantity = $days;
          }

          $model->order_id = $order_id;
          $model->product_item_id = $product_item->id;
          $model->description = $product->description;
          $model->unit_cost = $product->unit_cost;
          $model->total = $product->unit_cost * $model->quantity;
          $model->save();

          return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    /**
     * Updates an existing OrderItem model.
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
     * Deletes an existing OrderItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['order/cart']);
    }

    /**
     * Finds the OrderItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
