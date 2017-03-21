<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:44
 */

namespace frontend\components;

use app\models\PlayPositions;

class FigureBuilderComponent
{
    public static function build()
    {
        return $figures = [
            $whitePawn1 = new PawnComponent('white', 1),
            $whitePawn2 = new PawnComponent('white', 2),
            $whitePawn3 = new PawnComponent('white', 3),
            $whitePawn4 = new PawnComponent('white', 4),
            $whitePawn5 = new PawnComponent('white', 5),
            $whitePawn6 = new PawnComponent('white', 6),
            $whitePawn7 = new PawnComponent('white', 7),
            $whitePawn8 = new PawnComponent('white', 8),
            $whiteKnight1 = new KnightComponent('white', 1),
            $whiteKnight2 = new KnightComponent('white', 2),
            $whiteBishop1 = new BishopComponent('white', 1),
            $whiteBishop2 = new BishopComponent('white', 2),
            $whiteRook1 = new RookComponent('white', 1),
            $whiteRook2 = new RookComponent('white', 2),
            $whiteQueen = new QueenComponent('white'),
            $whiteKing = new KingComponent('white'),
        ];
    }

    public static function back($figures) {
        foreach ($figures as $item) {
            $position = PlayPositions::findOne(['figure_id' => $item->id]);
            $position->figure_id = $item->id;
            $position->current_x = $item->startPositionX;
            $position->current_y = $item->startPositionY;
            $position->save();
        }
    }
}