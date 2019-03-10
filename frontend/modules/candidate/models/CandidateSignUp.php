<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 10-Aug-18
 * Time: 12:53 PM
 */

namespace frontend\modules\candidate\models;


use common\components\PasswordValidator;
use common\models\login\User;

class CandidateSignUp extends User
{
    public $password;
    public $confirm_password;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['password', 'exam_type', 'exam_year'], 'required'];
        $rules[] = [['password'], PasswordValidator::class, 'preset' => PasswordValidator::SIMPLE, 'userAttribute' => 'username'];
        $rules[] = ['confirm_password', 'compare', 'compareAttribute' => 'password'];

        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['exam_ref'] = 'Candidate Number';

        return $labels;
    }

    public function attributeHints()
    {
        $hints = $this->attributeLabels();

        $hints['exam_ref'] = 'Enter your KCSE/KCPE Number e.g 01100003001';
        $hints['exam_type'] = 'Select the exam type';

        return $hints;
    }

    public function registerUser()
    {
        $this->username = "{$this->exam_ref}/{$this->exam_year}";
        $this->email ="{$this->exam_ref}@{$this->exam_year}.com"; //generate a random email
        $this->created_at = time();
        $this->updated_at = time();
        $this->setPassword($this->password);
        $this->generateAuthKey();

        return false;
        if ($this->validate()) {
            if ($this->save()) {
                return true;
            }
        }
        return false;
    }
}