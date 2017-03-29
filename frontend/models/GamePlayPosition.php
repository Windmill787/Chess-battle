<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_play_position".
 *
 * @property integer $game_id
 * @property integer $play_position_id
 *
 * @property Game $game
 * @property PlayPosition $playPosition
 */
class GamePlayPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_play_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'play_position_id'], 'required'],
            [['game_id', 'play_position_id'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['play_position_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlayPosition::className(), 'targetAttribute' => ['play_position_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_id' => 'Game ID',
            'play_position_id' => 'Play Position ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPosition()
    {
        return $this->hasOne(PlayPosition::className(), ['id' => 'play_position_id']);
    }
}
