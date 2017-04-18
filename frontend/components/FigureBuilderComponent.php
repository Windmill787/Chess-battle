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
    public static function build($game_id)
    {
        // need fix!
        return [
            $whitePawn1 = new PawnComponent('white', 1, $game_id),
            $whitePawn2 = new PawnComponent('white', 2, $game_id),
            $whitePawn3 = new PawnComponent('white', 3, $game_id),
            $whitePawn4 = new PawnComponent('white', 4, $game_id),
            $whitePawn5 = new PawnComponent('white', 5, $game_id),
            $whitePawn6 = new PawnComponent('white', 6, $game_id),
            $whitePawn7 = new PawnComponent('white', 7, $game_id),
            $whitePawn8 = new PawnComponent('white', 8, $game_id),
            $whiteKnight1 = new KnightComponent('white', 1, $game_id),
            $whiteKnight2 = new KnightComponent('white', 2, $game_id),
            $whiteBishop1 = new BishopComponent('white', 1, $game_id),
            $whiteBishop2 = new BishopComponent('white', 2, $game_id),
            $whiteRook1 = new RookComponent('white', 1, $game_id),
            $whiteRook2 = new RookComponent('white', 2, $game_id),
            $whiteQueen = new QueenComponent('white', $game_id),
            $whiteKing = new KingComponent('white', $game_id),

            $blackPawn1 = new PawnComponent('black', 1, $game_id),
            $blackPawn2 = new PawnComponent('black', 2, $game_id),
            $blackPawn3 = new PawnComponent('black', 3, $game_id),
            $blackPawn4 = new PawnComponent('black', 4, $game_id),
            $blackPawn5 = new PawnComponent('black', 5, $game_id),
            $blackPawn6 = new PawnComponent('black', 6, $game_id),
            $blackPawn7 = new PawnComponent('black', 7, $game_id),
            $blackPawn8 = new PawnComponent('black', 8, $game_id),
            $blackKnight1 = new KnightComponent('black', 1, $game_id),
            $blackKnight2 = new KnightComponent('black', 2, $game_id),
            $blackBishop1 = new BishopComponent('black', 1, $game_id),
            $blackBishop2 = new BishopComponent('black', 2, $game_id),
            $blackRook1 = new RookComponent('black', 1, $game_id),
            $blackRook2 = new RookComponent('black', 2, $game_id),
            $blackQueen = new QueenComponent('black', $game_id),
            $blackKing = new KingComponent('black', $game_id),
        ];
    }

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