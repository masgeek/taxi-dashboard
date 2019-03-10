<?php

namespace frontend\modules\candidate\controllers;

use Yii;
use common\controllers\BaseWebController;
use frontend\modules\candidate\models\CandidateSignUp;

/**
 * Default controller for the `candidate` module
 */
class DefaultController extends BaseWebController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return $behaviors;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        $this->view->title = 'Candidate Sign Up';
        $model = new CandidateSignUp();
        if ($model->load(Yii::$app->request->post())) {
            $model->registerUser();
            $model->validate();
            var_dump($model->getErrors());
            //$model->save();
            return 1;
        }
        return $this->render('sign-up', ['model' => $model]);
        //return $this->render('index');
    }
}
