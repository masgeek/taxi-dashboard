<?php

namespace backend\modules\setup\controllers;

use common\controllers\BaseWebController;
use common\helper\ImageHelper;
use  common\models\MenuCategory as MENU_CATEGORY;
use common\models\base\MenuItem as MENU_ITEMS;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\helpers\Json;

class UploadController extends BaseWebController
{
    /**
     * @param $rank
     * @return string
     */
    public function actionIndex($rank)
    {
        switch ($rank) {
            default:
            case "category":
                $model = new MENU_CATEGORY();
                break;
            case "menuitem":
                $model = new MENU_ITEMS();
                break;

        }


        $imageFile = UploadedFile::getInstance($model, 'IMAGE_FILE');

        $directoryA = Yii::getAlias('@app') . DIRECTORY_SEPARATOR;
        $directoryB = Yii::getAlias('@foodimageupload') . DIRECTORY_SEPARATOR;
        $directory = $directoryA . $directoryB;

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath)) {
                $imageHelper = new ImageHelper();
                $encoded = $imageHelper->encodeImage($filePath);
                //delete file after uploading
                unlink($filePath);
                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'imageType' => $encoded->getMimeType(),
                            'encodedImage' => $encoded->getDataUri(),
                        ],
                    ],
                ]);
            }
        }

        return '';
    }
}