<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "play_positions".
 *
 * @property integer $id
 * @property integer $figure_id
 * @property integer $current_x
 * @property integer $current_y
 * @property string $status
 *
 * @property Figure $figure
 */
class PlayPositions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'play_positions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['figure_id', 'current_x', 'current_y'], 'required'],
            [['figure_id', 'current_x', 'current_y'], 'integer'],
            [['status'], 'string', 'max' => 30],
            [['figure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Figure::className(), 'targetAttribute' => ['figure_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'figure_id' => 'Figure ID',
            'current_x' => 'Current X',
            'current_y' => 'Current Y',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFigure()
    {
        return $this->hasOne(Figure::className(), ['id' => 'figure_id']);
    }
}
