<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attack".
 *
 * @property integer $id
 * @property integer $figure_id
 * @property integer $attack_row
 * @property integer $attack_col
 *
 * @property Figure $figure
 */
class Attack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attack';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['figure_id'], 'required'],
            [['figure_id', 'attack_row', 'attack_col'], 'integer'],
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
            'attack_row' => 'Attack Row',
            'attack_col' => 'Attack Col',
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
