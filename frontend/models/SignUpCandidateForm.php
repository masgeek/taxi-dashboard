<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 10-Aug-18
 * Time: 12:53 PM
 */

namespace frontend\models;


use common\models\login\User;

class SignUpCandidateForm extends User
{
    public $password;
    public $confirm_password;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['password', 'exam_type'], 'required'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function rulesOld()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\login\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\login\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
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
        $this->email = $this->username; //generate a random email
        $this->created_at = time();
        $this->updated_at = time();
        $this->setPassword($this->password);
        $this->generateAuthKey();
        if ($this->validate()) {
            if ($this->save()) {
                return true;
            }
        }
        return false;
    }
}