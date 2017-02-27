<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.02.17
 * Time: 12:42
 */

namespace frontend\components;

class PawnComponent extends FigureComponent
{
    public function __construct($name, $image, $config = [])
    {
        parent::__construct($name, $image, $config);
    }
}