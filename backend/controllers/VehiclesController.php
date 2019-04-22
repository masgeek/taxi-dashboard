<?php

namespace backend\controllers;

use common\controllers\BaseWebController;
use common\models\search\VehiclesSearch;
use common\models\Vehicles;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * VehiclesController implements the CRUD actions for Vehicles model.
 */
class VehiclesController extends BaseWebController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vehicles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehiclesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehicles model.
     * @param $slug
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = $this->findModelBySlug($slug);

        $this->view->title = $model->slug;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Vehicles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehicles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehicles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $slug
     * @return array|Vehicles|\yii\db\ActiveRecord|null
     * @throws NotFoundHttpException
     */
    protected function findModelBySlug($slug)
    {
        $model = Vehicles::find()->where(['slug' => $slug])->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Vehicles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vehicles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vehicles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->view->title = 'Update Vehicle: ' . ' ' . $model->slug;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vehicles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
