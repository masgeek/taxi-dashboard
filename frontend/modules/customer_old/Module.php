<?php

namespace app\modules\customer;

/**
 * customer module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\customer\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //$this->layoutPath = \Yii::getAlias('@app/themes/porto_theme/layouts/');
        //$this->layout = 'customer_layout';
    }

}
