<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "{{%user_type}}".
 *
 * @property string $user_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 *
 * @property \common\models\Users[] $users
 */
class UserType extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_type'], 'string', 'max' => 20],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['user_type'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_type}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_type' => 'User Type',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\common\models\Users::className(), ['user_type' => 'user_type']);
    }
    }
