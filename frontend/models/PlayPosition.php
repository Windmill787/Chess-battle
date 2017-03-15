<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "play_position".
 *
 * @property integer $id
 * @property integer $figure_id
 * @property integer $from_col
 * @property integer $from_row
 * @property integer $to_col
 * @property integer $to_row
 * @property integer $replaced_to
 * @property integer $is_in_check
 * @property integer $pawn_up_to
 *
 * @property GamePlayPosition[] $gamePlayPositions
 * @property Game[] $games
 * @property Figure $figure
 * @property Figure $pawnUpTo
 * @property Figure $replacedTo
 */
class PlayPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'play_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['figure_id', 'from_col', 'from_row', 'to_col', 'to_row', 'replaced_to', 'is_in_check', 'pawn_up_to'], 'integer'],
            [['figure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Figure::className(), 'targetAttribute' => ['figure_id' => 'id']],
            [['pawn_up_to'], 'exist', 'skipOnError' => true, 'targetClass' => Figure::className(), 'targetAttribute' => ['pawn_up_to' => 'id']],
            [['replaced_to'], 'exist', 'skipOnError' => true, 'targetClass' => Figure::className(), 'targetAttribute' => ['replaced_to' => 'id']],
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
            'from_col' => 'From Col',
            'from_row' => 'From Row',
            'to_col' => 'To Col',
            'to_row' => 'To Row',
            'replaced_to' => 'Replaced To',
            'is_in_check' => 'Is In Check',
            'pawn_up_to' => 'Pawn Up To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamePlayPositions()
    {
        return $this->hasMany(GamePlayPosition::className(), ['play_position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['id' => 'game_id'])->viaTable('game_play_position', ['play_position_id' => 'id']);
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
    public function getPawnUpTo()
    {
        return $this->hasOne(Figure::className(), ['id' => 'pawn_up_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplacedTo()
    {
        return $this->hasOne(Figure::className(), ['id' => 'replaced_to']);
    }
}
