<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 27.02.17
 * Time: 11:54
 */

namespace frontend\components;


class BishopComponent extends FigureComponent
{
    public $name = 'bishop';

    public function __construct($color, $number = null, $config = [])
    {
        parent::__construct($color, $this->name, $number, $config);
    }
}