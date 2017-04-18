<?php
use frontend\components\PawnComponent;
use frontend\components\KnightComponent;
use frontend\components\BishopComponent;
use frontend\components\RookComponent;
use frontend\components\QueenComponent;
use frontend\components\KingComponent;

Yii::$container->set('figures', function ($container, $params, $game_id) {
    return [
        new PawnComponent('white', 1, $game_id),
        new PawnComponent('white', 2, $game_id),
        new PawnComponent('white', 3, $game_id),
        new PawnComponent('white', 4, $game_id),
        new PawnComponent('white', 5, $game_id),
        new PawnComponent('white', 6, $game_id),
        new PawnComponent('white', 7, $game_id),
        new PawnComponent('white', 8, $game_id),
        new KnightComponent('white', 1, $game_id),
        new KnightComponent('white', 2, $game_id),
        new BishopComponent('white', 1, $game_id),
        new BishopComponent('white', 2, $game_id),
        new RookComponent('white', 1, $game_id),
        new RookComponent('white', 2, $game_id),
        new QueenComponent('white', $game_id),
        new KingComponent('white', $game_id),

        new PawnComponent('black', 1, $game_id),
        new PawnComponent('black', 2, $game_id),
        new PawnComponent('black', 3, $game_id),
        new PawnComponent('black', 4, $game_id),
        new PawnComponent('black', 5, $game_id),
        new PawnComponent('black', 6, $game_id),
        new PawnComponent('black', 7, $game_id),
        new PawnComponent('black', 8, $game_id),
        new KnightComponent('black', 1, $game_id),
        new KnightComponent('black', 2, $game_id),
        new BishopComponent('black', 1, $game_id),
        new BishopComponent('black', 2, $game_id),
        new RookComponent('black', 1, $game_id),
        new RookComponent('black', 2, $game_id),
        new QueenComponent('black', $game_id),
        new KingComponent('black', $game_id),
    ];
});