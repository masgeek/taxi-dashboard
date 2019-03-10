<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 15-Aug-18
 * Time: 2:17 PM
 */

namespace common\components;


use kartik\password\StrengthValidator;

class PasswordValidator extends StrengthValidator
{
    const SIMPLE = 'simple';
}