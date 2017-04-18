<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:44
 */

namespace frontend\components;

use app\models\Figure;
use app\models\Game;
use app\models\PlayPositions;
use yii\base\Component;
use Yii;

class FigureBuilderComponent extends Component
{
    public static function back($figures, $game_id) {
        $game = Game::findOne($game_id);
        $game->move = 1;
        $game->save();
        foreach ($figures as $figure) {
            $position = PlayPositions::findOne(['game_id' => $game_id, 'figure_id' => $figure->id]);
            $position->figure_id = $figure->id;
            $position->current_x = $figure->startPositionX;
            $position->current_y = $figure->startPositionY;
            $position->already_moved = 0;
            $position->save();
        }
    }

    public static function resetStatuses($game_id) {
        $figures = PlayPositions::find()
            ->where(['game_id' => $game_id, 'status' => 'killed'])
            ->all();
        foreach ($figures as $figure) {
            $figure->status = 'active';
            $figure->save();
        }
    }
}