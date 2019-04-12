<?php

namespace frontend\controllers;

use Yii;
use app\models\HotelRoom;
use app\models\HotelRoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * HotelRoomController implements the CRUD actions for HotelRoom model.
 */
class HotelRoomController extends Controller
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
     * Lists all HotelRoom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HotelRoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HotelRoom model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_miniview', [
                        'model' => $model
            ]);
        } else {
            return $this->render('view', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Creates a new HotelRoom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HotelRoom();
        $model->loadDefaultValues();

        if($data = Yii::$app->request->get())
        {
            $model->organization_id = $data['organization_id'];
        }

        if ($model->load(Yii::$app->request->post()))
        {
            // print_r($_FILES);
            // die();

            if($model->file_1 = UploadedFile::getInstance($model, 'file_1') !== null )
            {
              $model->picture = $model->upload(UploadedFile::getInstance($model, 'file_1'));
            }

            $model->save();
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
     * Updates an existing HotelRoom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) )
        {
            if($model->file_1 = UploadedFile::getInstance($model, 'file_1') !== null )
            {
              $model->picture = $model->upload(UploadedFile::getInstance($model, 'file_1'));
            }

            $model->save();

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
     * Deletes an existing HotelRoom model.
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
     * Finds the HotelRoom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HotelRoom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HotelRoom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $reservations = \app\models\Product::find()->where(['>', 'hotel_room_id', '0'])->all();

        $events = array();

        foreach ($reservations AS $reservation_item){
          //Testing
          $Event = new \yii2fullcalendar\models\Event();
          $Event->id = $reservation_item->id;
          $Event->title = $reservation_item->name;
          $Event->start = date('Y-m-d\TH:i:s\Z',strtotime($reservation_item->start_date));
          $Event->end = date('Y-m-d\TH:i:s\Z',strtotime($reservation_item->end_date));
          $events[] = $Event;

        }

        return $events;
      }

    public function actionCalendar()
    {
        return $this->render('calendar');
    }
}
