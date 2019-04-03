<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%user_type}}".
 *
 * @property string $user_type User Type
 * @property string $created_at
 * @property string $updated_at
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
        return '{{%user_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_type'], 'string', 'max' => 20],
            [['user_type'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_type' => 'User Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['user_type' => 'user_type']);
    }
}
