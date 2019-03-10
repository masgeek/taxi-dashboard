<?php

namespace frontend\modules\customer;

/**
 * customer module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\customer\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //$this->layoutPath = \Yii::getAlias('@frontend/themes/slim-theme/layouts/');
    }
}
