<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "start_position".
 *
 * @property integer $id
 * @property integer $figure_id
 * @property integer $start_col
 * @property integer $start_row
 *
 * @property Figure $figure
 */
class StartPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'start_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['figure_id', 'start_col', 'start_row'], 'integer'],
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
            'start_col' => 'Start Col',
            'start_row' => 'Start Row',
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
