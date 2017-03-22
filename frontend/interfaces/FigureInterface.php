<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 15:22
 */

namespace frontend\interfaces;


interface FigureInterface
{
    public function move();

    public function attack();
}