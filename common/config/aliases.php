<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');

/*
\Yii::setAlias('@foodimageupload', 'images' . DIRECTORY_SEPARATOR . 'foodimages' . DIRECTORY_SEPARATOR);
\Yii::setAlias('@foodimages', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'foodimages' . DIRECTORY_SEPARATOR);
\Yii::setAlias('@appimages', 'images/app_images/');
\Yii::setAlias('@logsfolder', 'logs');*/


\Yii::setAlias('@foodimageupload', 'images' . DIRECTORY_SEPARATOR . 'foodimages' . DIRECTORY_SEPARATOR);
\Yii::setAlias('@imagesfolder', dirname((__DIR__)) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'foodimages' . DIRECTORY_SEPARATOR);
\Yii::setAlias('@foodimages', 'images/foodimages/');
\Yii::setAlias('@appimages', 'images/app_images/');
\Yii::setAlias('@logsfolder', 'logs');