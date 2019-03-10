<?php

namespace frontend\modules\customer\controllers;

use yii\web\Controller as BaseWebController;
use common\helper\OrderHelper;
use common\models\MenuItem;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `customer` module
 */
class DefaultController extends BaseWebController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = '//menu-cart';

        $this->view->title = 'Orders';

        $this->view->params['title'] = 'Orders Cart';

        $user_id = \Yii::$app->user->id;

        //get the list of orders
        $this->view->params['cart_items'] = OrderHelper::GetCartItems($user_id);


        //lets get the list of pizzas on offer
        $menu_item = new ActiveDataProvider([
            'query' => MenuItem::find()->orderBy(['MENU_CAT_ID' => SORT_ASC]),
        ]);

        return $this->render('view', [
            'dataProvider' => $menu_item,
        ]);
    }
}
