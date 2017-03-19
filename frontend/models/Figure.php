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
 * @property string $start_position
 *
 * @property PlayPosition[] $playPositions
 * @property PlayPosition[] $playPositions0
 * @property PlayPosition[] $playPositions1
 * @property StartPosition[] $startPositions
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
            [['color'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 6],
            [['number'], 'string', 'max' => 5],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPositions()
    {
        return $this->hasMany(PlayPosition::className(), ['figure_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPositions0()
    {
        return $this->hasMany(PlayPosition::className(), ['pawn_up_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPositions1()
    {
        return $this->hasMany(PlayPosition::className(), ['replaced_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartPositions()
    {
        return $this->hasMany(StartPosition::className(), ['figure_id' => 'id']);
    }
}
