<?php

namespace app\models;

/**
 * This is the model class for table "loan_requests".
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $term
 * @property string|null $status
 * @property string|null $created_at
 */
class LoanRequest extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => null],
            [['user_id', 'amount', 'term'], 'required'],
            [['user_id', 'amount', 'term'], 'default', 'value' => null],
            [['user_id', 'amount', 'term'], 'integer'],
            [['created_at'], 'safe'],
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'term' => 'Term',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

}
