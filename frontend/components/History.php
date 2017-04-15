<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 15.04.17
 * Time: 18:21
 */

namespace frontend\components;


class History
{
    /**
     * @param $figures FigureComponent
     * @return mixed
     */
    public function display($figures) {
        foreach ($figures as $figure) {
            if ($figure->currentPositionY != $figure->startPositionY &&
                $figure->currentPositionX != $figure->startPositionX) {
                return $figure;
            }
        }
    }
}