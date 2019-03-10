<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property int $USER_TYPE_ID
 * @property string $USER_TYPE_NAME
 *
 * @property Users[] $users
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USER_TYPE_NAME'], 'required'],
            [['USER_TYPE_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'USER_TYPE_ID' => 'U S E R T Y P E I D',
            'USER_TYPE_NAME' => 'U S E R T Y P E N A M E',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['USER_TYPE' => 'USER_TYPE_ID']);
    }
}
