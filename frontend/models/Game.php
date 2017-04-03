<?php

namespace app\models;

use Yii;
use common\models\User;
use app\models\PlayPositions;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $white_user_id
 * @property integer $black_user_id
 * @property integer $play_position_id
 *
 * @property User $blackUser
 * @property PlayPositions $playPosition
 * @property User $whiteUser
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
            [['white_user_id', 'black_user_id', 'play_position_id'], 'required'],
            [['white_user_id', 'black_user_id', 'play_position_id'], 'integer'],
            [['black_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['black_user_id' => 'id']],
            [['play_position_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlayPositions::className(), 'targetAttribute' => ['play_position_id' => 'id']],
            [['white_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['white_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'white_user_id' => 'White User ID',
            'black_user_id' => 'Black User ID',
            'play_position_id' => 'Play Position ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlackUser()
    {
        return $this->hasOne(User::className(), ['id' => 'black_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPosition()
    {
        return $this->hasOne(PlayPositions::className(), ['id' => 'play_position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWhiteUser()
    {
        return $this->hasOne(User::className(), ['id' => 'white_user_id']);
    }
}
