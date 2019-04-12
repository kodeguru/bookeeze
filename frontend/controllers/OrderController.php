<?php

namespace frontend\controllers;

use Yii;
use app\models\Order;
use app\models\Invoice;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionCart()
    {
        // Open a new session
        $session = Yii::$app->session;

        // check if a session is already open and create an [Order] header
        if ($session->isActive && $order = Order::find()->where(['session_id' => $session->id, 'order_status_id' => Order::OPEN_ORDER])->one())
        {
          if (Yii::$app->request->isAjax) {
              return $this->renderAjax('cart', [
                          'model' => $order
              ]);
          } else {
              return $this->render('cart', [
                          'model' => $order
              ]);
          }
      }
      //set flash message and redirect
      $session->setFlash('emptyCart', "Your shopping cart is empty. Let's shop around!");
      return $this->redirect(['product/index']);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Open a new session
        $session = Yii::$app->session;
        // $order_id = 0;

        // check if a session is already open and create an [Order] header
        if ($session->isActive && $order = Order::find()
            ->where(['session_id' => $session->id, 'order_status_id' => Order::OPEN_ORDER ])
            ->one())
        {
          $order_id = $order->id;
        }
        else
        {
          $session->open();
          $order = new Order();
          $order->loadDefaultValues();
          $order->session_id = $session->id;
          $order->save();

          $order_id = $order->id;
        }

        return $order_id;
    }

    /**
     * Updates an existing Order model.
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
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
