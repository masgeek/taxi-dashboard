<?php

namespace common\models\base;

/**
 * This is the base model class for table "{{%client_types}}".
 *
 * @property string $client_type
 * @property string $updated_by
 * @property string $created_by
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Clients[] $clients
 */
class ClientTypes extends \common\extend\BaseModel
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_type'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['client_type'], 'string', 'max' => 15],
            [['updated_by', 'created_by'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 30],
            [['client_type'], 'unique'],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%client_types}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_type' => 'Client Type',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(\common\models\Clients::className(), ['client_type' => 'client_type']);
    }
}
