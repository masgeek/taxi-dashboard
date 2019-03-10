<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace api\modules\v2\controllers;


use api\behaviours\Apiauth;
use common\controllers\BaseRestController;
use common\models\search\LocationSearch;

class LocationController extends BaseRestController
{
    /**
     * @var object
     */
    public $modelClass = 'common\models\Location';
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['apiauth'] = [
            'class' => Apiauth::class,
            'exclude' => ['index','view'],
        ];

        return $behaviors;
    }


    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {

        $searchModel = new LocationSearch();

        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}