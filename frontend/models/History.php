<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $figure_id
 * @property integer $from_x
 * @property integer $from_y
 * @property integer $to_x
 * @property integer $to_y
 *
 * @property Figure $figure
 * @property Game $game
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'figure_id', 'from_x', 'from_y', 'to_x', 'to_y'], 'required'],
            [['game_id', 'figure_id', 'from_x', 'from_y', 'to_x', 'to_y'], 'integer'],
            [['figure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Figure::className(), 'targetAttribute' => ['figure_id' => 'id']],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'figure_id' => 'Figure ID',
            'from_x' => 'From X',
            'from_y' => 'From Y',
            'to_x' => 'To X',
            'to_y' => 'To Y',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFigure()
    {
        return $this->hasOne(Figure::className(), ['id' => 'figure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }
}
