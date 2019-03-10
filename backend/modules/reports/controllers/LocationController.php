<?php

namespace backend\modules\reports\controllers;

use Yii;
use common\helper\APP_UTILS;
use common\models\VwSalesReports as ReportModel;
use common\models\search\PizzaReportSearch;
use common\controllers\BaseWebController;
use common\models\search\ReportSearch;

class LocationController extends BaseWebController
{
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->LocationSearch(Yii::$app->request->queryParams);

        if (Yii::$app->request->isGet) {
            //set the title
            $search = Yii::$app->request->get('ReportSearch');

            $orderDate = $search['ORDER_DATE'];
            $date = explode("TO", $orderDate);
            $start = isset($date[0]) ? $date[0] : APP_UTILS::FirstDayOfMonth();
            $end = isset($date[1]) ? $date[1] : APP_UTILS::LastDayOfMonth();

        }
        $startDate = APP_UTILS::FormatDate(trim($start));
        $endDate = APP_UTILS::FormatDate(trim($end));

        $this->view->title = "Location Reports between {$startDate} and {$endDate}";

        return $this->render('/report/general-reports', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'context' => ReportModel::CONTEXT_LOCATION,
        ]);
    }
}
