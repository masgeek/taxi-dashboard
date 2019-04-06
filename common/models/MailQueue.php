<?php

namespace common\models;

use common\models\base\MailQueue as BaseMailQueue;

/**
 * This is the model class for table "mail_queue".
 */
class MailQueue extends BaseMailQueue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['subject', 'body'], 'string'],
            [['sent'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['receipent'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20]
        ]);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'mail_id' => 'Mail ID',
            'receipent' => 'Receipent',
            'subject' => 'Subject',
            'body' => 'Body',
            'sent' => 'Sent',
            'type' => 'Type',
        ];
    }
}
