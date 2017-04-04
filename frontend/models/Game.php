<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $white_user_id
 * @property integer $black_user_id
 * @property string $status
 * @property integer $move
 *
 * @property User $blackUser
 * @property User $whiteUser
 * @property PlayPositions[] $playPositions
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
            [['white_user_id', 'black_user_id'], 'required'],
            [['white_user_id', 'black_user_id', 'move'], 'integer'],
            [['status'], 'string', 'max' => 30],
            [['black_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['black_user_id' => 'id']],
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
            'status' => 'Status',
            'move' => 'Move',
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
    public function getWhiteUser()
    {
        return $this->hasOne(User::className(), ['id' => 'white_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayPositions()
    {
        return $this->hasMany(PlayPositions::className(), ['game_id' => 'id']);
    }
}
