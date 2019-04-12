<?php

namespace frontend\controllers;

use Yii;
use app\models\OrganizationServiceOffer;
use app\models\OrganizationServiceOfferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganizationServiceOfferController implements the CRUD actions for OrganizationServiceOffer model.
 */
class OrganizationServiceOfferController extends Controller
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
     * Lists all OrganizationServiceOffer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationServiceOfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrganizationServiceOffer model.
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
     * Creates a new OrganizationServiceOffer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate($id)
      {
          $model = new OrganizationServiceOffer();
          $model->loadDefaultValues();
          $model->organization_id = $id;

          if ($model->load(Yii::$app->request->post())) {
              $service_offer_ids = $_POST['OrganizationServiceOffer']['service_offer_id'];
              foreach ($service_offer_ids as $service_offer_id) {
                  $model = new OrganizationServiceOffer();
                  $model->loadDefaultValues();
                  $model->organization_id = $id;
                  $model->service_offer_id = $service_offer_id;
                  $model->save();
              }
              return $this->redirect(Yii::$app->request->referrer);

          } elseif (Yii::$app->request->isAjax) {
              return $this->renderAjax('create', [
                          'model' => $model,
              ]);
          } else {
              return $this->render('create', [
                          'model' => $model,
              ]);
          }

      }

    /**
     * Updates an existing OrganizationServiceOffer model.
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
     * Deletes an existing OrganizationServiceOffer model.
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
     * Finds the OrganizationServiceOffer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrganizationServiceOffer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrganizationServiceOffer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
