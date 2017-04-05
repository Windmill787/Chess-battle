<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "play_positions".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $figure_id
 * @property integer $current_x
 * @property integer $current_y
 * @property string $status
 * @property integer $already_moved
 *
 * @property Figure $figure
 * @property Game $game
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
            [['game_id', 'figure_id', 'current_x', 'current_y'], 'required'],
            [['game_id', 'figure_id', 'current_x', 'current_y', 'already_moved'], 'integer'],
            [['status'], 'string', 'max' => 30],
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
            'current_x' => 'Current X',
            'current_y' => 'Current Y',
            'status' => 'Status',
            'already_moved' => 'Already Moved',
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
