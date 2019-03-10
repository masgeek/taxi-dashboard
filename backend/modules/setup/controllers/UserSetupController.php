<?php

namespace backend\modules\setup\controllers;

use common\models\login\User;
use Yii;
use common\models\Users;
use common\models\search\UserSearch;
use common\controllers\BaseWebController;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserSetupController implements the CRUD actions for Users model.
 */
class UserSetupController extends BaseWebController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'except' => ['register', 'reset-pass'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
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

    public function actionPromote($id)
    {
        $model = $this->findModel($id);

        $model->RESET_TOKEN = 'NONE';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('promote', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Creates a new USERS_MODEL model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegister()
    {
        $this->layout = 'register_layout';

        $model = new Users();

        //$model->USER_TYPE = 1;
        //$model->LOCATION_ID = 1;
        if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post('USERS_MODEL');
            $password = $post['PASSWORD'];
            $model->PASSWORD = sha1($password);
            $model->RESET_TOKEN = 'NONE';
            if ($model->save()) {
                //go to login page
                return $this->redirect(['//site/login']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        $model->RESET_TOKEN = 'NONE';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->USER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionResetPass($token)
    {
        $this->layout = 'login_layout';
        $this->view->title = 'Change Password';
        $model = User::findByToken($token);
        if ($model != null) {
            if ($model->load(Yii::$app->request->post())) {

                $post = Yii::$app->request->post('USERS_MODEL');
                $password = $post['PASSWORD'];
                $model->PASSWORD = sha1($password);
                $model->RESET_TOKEN = 'NONE';
                if ($model->save()) {
                    //go to login page
                    return $this->redirect(['//site/login']);
                }
            }

            return $this->render('_change-password', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['//site/login']);
    }

    /**
     * Deletes an existing Users model.
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
}
