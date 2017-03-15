<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $white_player_id
 * @property integer $black_player_id
 * @property integer $message_id
 * @property string $date_of_match
 *
 * @property User $blackPlayer
 * @property Message $message
 * @property User $whitePlayer
 * @property GamePlayPosition[] $gamePlayPositions
 * @property PlayPosition[] $playPositions
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['white_player_id', 'black_player_id', 'message_id'], 'integer'],
            [['date_of_match'], 'safe'],
            [['black_player_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['black_player_id' => 'id']],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => Message::className(), 'targetAttribute' => ['message_id' => 'id']],
            [['white_player_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['white_player_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'white_player_id' => 'White Player ID',
            'black_player_id' => 'Black Player ID',
            'message_id' => 'Message ID',
            'date_of_match' => 'Date Of Match',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlackPlayer()
    {
        return $this->hasOne(User::className(), ['id' => 'black_player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWhitePlayer()
    {
        return $this->hasOne(User::className(), ['id' => 'white_player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamePlayPositions()
    {
        return $this->hasMany(GamePlayPosition::className(), ['game_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPositions()
    {
        return $this->hasMany(PlayPosition::className(), ['id' => 'play_position_id'])->viaTable('game_play_position', ['game_id' => 'id']);
    }
}
