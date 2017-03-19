<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chessboard".
 *
 * @property integer $id
 * @property integer $x
 * @property integer $y
 */
class Chessboard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chessboard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['x', 'y'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'x' => 'X',
            'y' => 'Y',
        ];
    }
}
