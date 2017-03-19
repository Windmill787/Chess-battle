<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "move".
 *
 * @property integer $id
 * @property integer $figure_id
 * @property integer $move_x
 * @property integer $move_y
 *
 * @property Figure $figure
 */
class Move extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'move';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['figure_id'], 'required'],
            [['figure_id', 'move_x', 'move_y'], 'integer'],
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
            'move_x' => 'Move X',
            'move_y' => 'Move Y',
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
