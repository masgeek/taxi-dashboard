<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 10/15/2017
 * Time: 3:30 PM
 */

namespace common\helper;

use common\components\SmsComponent;
use Yii;
use app\model_extended\CART_MODEL;
use common\models\Users as USERS_MODEL;
use PHPMailer\PHPMailer\PHPMailer;
use yii\base\Exception;
use yii\helpers\Url;

class APP_UTILS
{
    const PAYMENT_METHOD_MOBILE = 'MOBILE';
    const PAYMENT_METHOD_CARD = 'CARD';

    const KITCHEN_SCOPE = 'KITCHEN';
    const CHEF_SCOPE = 'CHEF';
    const RIDER_SCOPE = 'RIDER';
    const OFFICE_SCOPE = 'OFFICE';
    const ALL_SCOPE = 'ALL';


    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_ALLOCATE_KITCHEN = 'allocate_kitchen';
    const SCENARIO_CONFIRM_ORDER = 'confirm_order';
    const SCENARIO_PREPARE_ORDER = 'prepare_order';
    const SCENARIO_ORDER_READY = 'order_ready';
    const SCENARIO_ASSIGN_CHEF = 'assign_chef';
    const SCENARIO_ASSIGN_RIDER = 'assign_rider';
    const SCENARIO_UPDATE_RIDER = 'update_rider';


    const USER_TYPE_ADMIN = 'ADMIN';
    const USER_TYPE_CUSTOMER = 'CUSTOMER';

    /**
     * @return int
     */
    public static function GetTimeStamp()
    {
        $date = new \DateTime();
        return $date->getTimestamp();
    }

    /**
     * @param int $length
     * @return string
     * @throws \yii\base\Exception
     */
    public static function GenerateToken($length = 32)
    {
        $randomString = \Yii::$app->getSecurity()->generateRandomString($length);
        return $randomString;
    }

    /**
     * @param $userModel
     * @param $orderNumber
     * @param $orderStatus
     * @return bool
     */
    public static function SendSMS($userModel, $orderNumber, $orderStatus)
    {
        /* @var $sms SmsComponent */
        $sms = Yii::$app->sms;

        $smsStatus = [
            OrderHelper::STATUS_ORDER_CONFIRMED,
            OrderHelper::STATUS_RIDER_ASSIGNED,
            OrderHelper::STATUS_RIDER_DISPATCHED,
        ];

        $sms_text = "Your order $orderNumber status is $orderStatus.";


        $params = [
            'to' => $userModel->MOBILE,
            'text' => $sms_text,
        ];

        if (in_array($orderStatus, $smsStatus)) {
            $sms->SendSms($params);
            return true;
        }

        return false;
    }

    /**
     * @param $userModel USERS_MODEL
     * @param $orderNumber
     * @param $orderStatus
     * @param string $baseUrl
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws \yii\base\Exception
     */
    public static function SendOrderEmailWithReceipt($userModel, $orderNumber, $orderStatus, $baseUrl = 'http://pizzaout.so/')
    {
        $emailStatus = [
            OrderHelper::STATUS_ORDER_CONFIRMED,
            OrderHelper::STATUS_RIDER_ASSIGNED,
            OrderHelper::STATUS_RIDER_DISPATCHED,
        ];
        $subject = 'Pizza Out Order Alert';

        $randomString = self::GenerateToken();

        $link = "{$baseUrl}orders/print?id=$orderNumber&token=$randomString";

        $receiptLink = '<a href="' . $link . '" target="_blank">Receipt Here</a>';

        $body = <<<BODY
Dear <strong>$userModel->SURNAME</strong>
<p>
Your order $orderNumber status is $orderStatus.
</p>
<p>
Please find your $receiptLink.
</p>
<p>
Thank you for your business, we value your feedback. <br/>
Our Call Center Number is: <strong>2040</strong>
</p>
<p>
Regards,<br/>
Pizzaout Team
</p>
BODY;

        if (in_array($orderStatus, $emailStatus)) {
            return self::SendEmailBkp($userModel->EMAIL, $userModel->SURNAME, $body, $subject);
        }

        return false;
        // return self::SendEmailBkp($userModel->EMAIL, $userModel->SURNAME, $body, $subject);
    }

    /**
     * @param $userModel USERS_MODEL
     * @param string $baseUrl
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws \yii\base\Exception
     */
    public static function SendRecoveryEmail($userModel, $baseUrl = 'http://pizzaout.so/')
    {
        $randomString = self::GenerateToken();
        $subject = 'Password Recovery for ' . $userModel->SURNAME;

        $link = "{$baseUrl}user/reset-pass?token=$randomString";//Url::to("@web/user/reset-pass?token=$randomString", true);
        $body = 'Use this <a href="' . $link . '" target="_blank">link</a> to reset your password';

        $userModel->RESET_TOKEN = $randomString;
        $userModel->save();

        return self::SendEmailBkp($userModel->EMAIL, $userModel->SURNAME, $body, $subject);

    }

    /**
     * @param $toemail
     * @param $toname
     * @param $body
     * @param $subject
     * @param null $attachment
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    private static function SendEmailBkp($toemail, $toname, $body, $subject, $attachment = null)
    {
        $mail = new PHPMailer(false);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.pizzaout.so';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
            $mail->Username = 'support@pizzaout.so';                 // SMTP username
            $mail->Password = 'PQ*8Z(^V?ho}';                           // SMTP password
            //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 25;//587;                                    // TCP port to connect to                                 // TCP port to connect to


            //Recipients
            $mail->setFrom('support@pizzaout.so', 'PIZZA OUT');
            $mail->addAddress($toemail, $toname);     // Add a recipient
            $mail->addReplyTo('support@pizzaout.so', 'PIZZA OUT');

            //Attachments
            if ($attachment != null) {
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            }

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        return false;
    }

    /**
     * @param string $format
     * @return string
     */
    public
    static function GetCurrentDateTime($format = 'yyyy-MM-dd HH:mm:ss')
    {
        $date = date('Y-m-d H:i:s');
        return $date;
    }

    /**
     * @param string $format
     * @param int $period
     * @param string $durationType
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function GetFutureDateTime($format = 'yyyy-MM-dd HH:mm:ss', $period = 1, $durationType = 'M')
    {

        //return \Yii::$app->formatter->asDatetime('now', $format);
        $D = intval($period);
        $DC = strtoupper($durationType);

        $currentDate = date('d-M-Y'); //$this->getCourseFinishDate($regNumber);


        $date = new \DateTime($currentDate);
        $date->add(new \DateInterval('P' . $D . $DC)); //M Y W D
        $dueDate = $date->format('d-M-Y');

        return \Yii::$app->formatter->asDatetime($dueDate, $format);

    }


    public
    static function FormatDateTime($datetime, $timeOnly = false, $format = 'M d, Y, H:i:s')
    {
        return $datetime;
        try {
            $formatter = \Yii::$app->formatter;
            $tz = $formatter->timeZone;

            $date = date_create($datetime, timezone_open($tz));
            return $timeOnly ? date_format($date, $format) : date_format($date, $format);
        } catch (Exception $ex) {
            return $datetime;
        }

    }

    public static function FormatDate($datetime)
    {
        $formatter = \Yii::$app->formatter;
        $tz = $formatter->timeZone;

        $date = date_create($datetime, timezone_open($tz));

        //return $timeOnly ?date_format($date, 'H:i:s A') :date_format($date, 'M d, Y, H:i:s A');
        $formatted = date_format($date, 'M d, Y');

        return $formatted;


    }

    public static function isValidDate($string)
    {
        return (date('Y-m-d H:i:s', strtotime($string)) == $string);
    }

    public
    static function GetCartTimesTamp($user_id)
    {
        $model = CART_MODEL::findOne(['USER_ID' => $user_id]);
        return $model != null ? $model->CART_TIMESTAMP : self::GetTimeStamp();
    }

    /**
     * @param $image_url
     * @param string $imageFolder
     * @return string
     */
    public
    static function BuildImageUrlBase($image_url, $imageFolder = "@foodimages")
    {

        //return Yii::$app->homeUrl . '/' . $imageFolder;
        $cleanBaseURL = Url::base(true);
        $cleanBaseURL .= '/';

        return "{$cleanBaseURL}{$imageFolder}/{$image_url}";
    }

    /**
     * @param $image_url
     * @param bool $fromApi
     * @param string $alias
     * @param string $imageFolder
     * @return string
     */
    public
    static function BuildImageUrl($image_url, $fromApi = true, $alias = '@foodimages', $imageFolder = "images")
    {

        if ($alias != null) {
            $imageFolder = \Yii::getAlias($alias);
        }

        $baseUrl = Url::to([null], true);


        if ($fromApi) {
            $cleanBaseURL = substr($baseUrl, 0, strpos($baseUrl, "api"));
        } else {
            $cleanBaseURL = substr($baseUrl, 0, strpos($baseUrl, "customer"));
        }
        $parsed = parse_url($cleanBaseURL);
        if (empty($parsed['scheme'])) {
            //$urlStr = 'http://' . ltrim($urlStr, '/');
            $cleanBaseURL = substr($baseUrl, 0, strpos($baseUrl, "site"));
        }

        return "{$cleanBaseURL}{$imageFolder}/{$image_url}";
    }

    /**
     * @param $subject
     * @param array $params
     * @param array $recipient
     * @param string $layout
     * @param array $replyTo
     * @return bool
     */
    public static function SendEmail($subject, array $recipient, array $params, $layout = 'layouts/welcome', array $replyTo = ['support@pizzaout.so' => 'Pizza Out'])
    {
        $mailer = \Yii::$app->mailer->compose($layout, $params)
            ->setTo($recipient)
            ->setFrom(['noreply@pizzaout.so' => 'Pizza Out'])
            ->setReplyTo($replyTo)
            ->setSubject($subject)
            ->send();

        return $mailer;
    }

    public static function FirstDayOfMonth($format = 'Y-m-d 00:00:00')
    {
        return date($format, strtotime('first day of this month'));
    }


    public static function LastDayOfMonth($format = 'Y-m-d 23:59:59')
    {
        return date($format, strtotime('last day of this month'));
    }
}