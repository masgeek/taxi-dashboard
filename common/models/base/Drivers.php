<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%drivers}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property integer $active
 * @property string $password
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\AssignedVehicles[] $assignedVehicles
 */
class Drivers extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'mobile', 'password'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 20],
            [['active'], 'string', 'max' => 1],
            [['password', 'updated_by', 'created_by'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 30],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique'],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%drivers}}';
    }

    /**
     * @inheritdoc
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
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedVehicles()
    {
        return $this->hasMany(\common\models\AssignedVehicles::className(), ['driver_id' => 'id']);
    }
}
