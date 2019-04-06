<?php
/**
 * Created by PhpStorm.
 * User: MASGEEK
 * Date: 7/30/2018
 * Time: 8:10 PM
 */

namespace api\behaviours;


use yii\base\Behavior;
use yii\base\Controller;
use yii\web\NotAcceptableHttpException;

class Requestcheck extends Behavior
{

    public $requestbody;

    /**
     * Declares event handlers for the [[owner]]'s events.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    public function encryptUid($id)
    {
        $encryptUid = md5($this->encryptUid);
        return $this->$encryptUid;
    }

    /**
     * @param $event
     * @return bool
     * @throws NotAcceptableHttpException
     */
    public function beforeAction($event)
    {
        if ($this->requestbody && !is_array($this->requestbody)) {
            $event->isValid = false;
            throw new NotAcceptableHttpException("Invalid request data only JSON requests are allowed");
        }
        return $event->isValid;
    }

}