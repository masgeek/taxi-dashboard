<?php

namespace backend\modules\client\controllers;

use common\controllers\BaseWebController;
use common\models\search\UserSearch;
use common\models\Users;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BaseWebController
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAccessTokens = new \yii\data\ArrayDataProvider([
            'allModels' => $model->accessTokens,
        ]);
        $providerAuthorizationCodes = new \yii\data\ArrayDataProvider([
            'allModels' => $model->authorizationCodes,
        ]);
        $providerUserClient = new \yii\data\ArrayDataProvider([
            'allModels' => $model->userClients,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAccessTokens' => $providerAccessTokens,
            'providerAuthorizationCodes' => $providerAuthorizationCodes,
            'providerUserClient' => $providerUserClient,
        ]);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Action to load a tabular form grid
     * for AccessTokens
     * @return mixed
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     */
    public function actionAddAccessTokens()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('AccessTokens');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAccessTokens', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for AuthorizationCodes
     * @return mixed
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     */
    public function actionAddAuthorizationCodes()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('AuthorizationCodes');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAuthorizationCodes', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for UserClient
     * @return mixed
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     */
    public function actionAddUserClient()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('UserClient');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formUserClient', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
