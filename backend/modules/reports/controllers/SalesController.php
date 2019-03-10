<?php

namespace backend\modules\reports\controllers;

use Yii;
use common\helper\APP_UTILS;
use common\models\VwSalesReports as ReportModel;
use common\models\search\PizzaReportSearch;
use common\controllers\BaseWebController;
use common\models\search\ReportSearch;

class SalesController extends BaseWebController
{
    public function actionIndex()
    {
        return $this->render('/report/sales-reports');
    }
}
