<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "moves".
 *
 * @property integer $id
 * @property integer $figure_id
 * @property string $move
 * @property string $attack
 * @property string $first_move
 *
 * @property Figure $figure
 */
class Moves extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'moves';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['figure_id', 'move'], 'required'],
            [['figure_id'], 'integer'],
            [['move', 'attack', 'first_move'], 'string', 'max' => 255],
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
            'move' => 'Move',
            'attack' => 'Attack',
            'first_move' => 'First Move',
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
