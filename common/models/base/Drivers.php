<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%drivers}}".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property int $active
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 *
 * @property AssignedVehicles[] $assignedVehicles
 */
class Drivers extends \common\extend\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%drivers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'mobile', 'password'], 'required'],
            [['active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 20],
            [['password', 'updated_by', 'created_by', 'slug'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'active' => 'Active',
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedVehicles()
    {
        return $this->hasMany(AssignedVehicles::className(), ['driver_id' => 'id']);
    }
}
