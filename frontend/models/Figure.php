<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "figure".
 *
 * @property integer $id
 * @property string $color
 * @property string $name
 * @property string $number
 * @property integer $start_position
 * @property string $status
 *
 * @property Chessboard $startPosition
 * @property Moves[] $moves
 * @property PlayPositions[] $playPositions
 */
class Figure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'figure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_position'], 'required'],
            [['start_position'], 'integer'],
            [['color', 'number'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 6],
            [['status'], 'string', 'max' => 10],
            [['start_position'], 'exist', 'skipOnError' => true, 'targetClass' => Chessboard::className(), 'targetAttribute' => ['start_position' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'name' => 'Name',
            'number' => 'Number',
            'start_position' => 'Start Position',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartPosition()
    {
        return $this->hasOne(Chessboard::className(), ['id' => 'start_position']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoves()
    {
        return $this->hasMany(Moves::className(), ['figure_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPositions()
    {
        return $this->hasMany(PlayPositions::className(), ['figure_id' => 'id']);
    }
}
