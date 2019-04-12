<?php

namespace frontend\controllers;

use Yii;
use app\models\Product;
use app\models\ProductItem;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax) {
          return $this->renderAjax('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        } else {
          //return $this->redirect(['/site/index']);
          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        }
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
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
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /***
    * Finds available room_id
    * @params DateRangePicker
    * ***/
    public function actionAvailableRoom()
    {
        $service_date_range = Yii::$app->request->post('check_in_out_date');
        // $service_date_range = '2018-04-03+00:00 - 2018-04-04+23:00';
        $status = isset($service_date_range);

        $data = [];
        if ($status) {
                $data = \app\models\HotelRoom::getAvailableHotelRoomList($service_date_range);
                $results = array();
                $x = 0;
                foreach ($data as $key => $value) {
                	$y=0;
                	$org_name = $value['name'];
                	$type = $value['type'];	
                	$num = $value['num'];
                	$cost = $value['room_cost'];

                	if (!isset($results[$org_name])) $results[$org_name] = $value;

                	$results[$org_name]['rooms'][$type]['id'] = $value['hotel_room_id'];;
                	$results[$org_name]['rooms'][$type]['qty'] = $num;
                	$results[$org_name]['rooms'][$type]['type'] = $type;
                	$results[$org_name]['rooms'][$type]['cost'] = $cost;

                	// $results[$org_name]['rooms'][]['qty'] = $num;
                	// $results[$org_name]['rooms'][]['type'] = $type;
                	// $results[$org_name]['rooms'][]['cost'] = $cost;

                  	unset($results[$org_name]['type']);
                	unset($results[$org_name]['num']);
                	unset($results[$org_name]['room_cost']);
                	$x++;
                }
                // array_values($results);
                //$results = array_values($results);
                // foreach ($results as $key => $value) {
                // 	//var_dump($value);
                // 	array_values($results[$value['name']]['rooms']);
                // 	//array_values($value);
                // }
                //var_dump($results);

                $dates = explode(" - ", $service_date_range);
                $startdate = $dates[0];
                $enddate = $dates[1];

                $product_ids = array();

                // add items to product
                // foreach ($data as $key => $value) {
                //   $room_name = $value['name'];
                //   $description = "Booking at $room_name <p>Start/End Date: $startdate - $enddate</p>";

                //   $product = new Product();
                //   $product->loadDefaultValues();
                //   $product->hotel_room_id = $value['id'];
                //   $product->name = $value['name'];
                //   $product->description = $description;
                //   $product->unit_cost = $value['cost'];
                //   $product->start_date = $startdate;
                //   $product->end_date = $enddate;
                //   $product->save();

                //   $product_item = new ProductItem();
                //   $product_item->loadDefaultValues();
                //   $product_item->product_id = $product->id;
                //   $product_item->description = $description;
                //   $product_item->unit_cost = $product->unit_cost;
                //   $product_item->start_date = $product->start_date;
                //   $product_item->end_date = $product->end_date;
                //   $product_item->save();

                //   array_push($product_ids, $product->id);
                // }

                // $index = 0;
                // foreach ($data as &$record) {
                //   $record['product_id'] = $product_ids[$index++];
                // }s

                $dataProvider = new ArrayDataProvider([
                    'allModels' => $results,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'attributes' => ['id', 'name'],
                    ],
                ]);
                if (Yii::$app->request->isAjax) {
                	return $this->renderAjax('/hotel-room/_list', [
	                    'dataProvider' => $dataProvider,
	                ]);
	             } else {
	             	return $this->render('/hotel-room/_list', [
	                    'dataProvider' => $dataProvider,
	                ]);
	             }
        }
        echo "Sorry No results found";
    }
}
