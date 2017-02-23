<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 20.02.17
 * Time: 19:49
 */

namespace frontend\components;

use yii\base\Component;

class FigureComponent extends Component
{
    public $name;
    public $moveForward;
    public $image;

    public function __construct($name, $image, $config = [])
    {
        $this->name = $name;
        $this->image = $image;
        parent::__construct($config);
    }
}