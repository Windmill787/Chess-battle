<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 17.03.17
 * Time: 22:31
 */

namespace frontend\components;

use app\models\Chessboard;
use yii\base\Component;
use Yii;

class BoardComponent extends Component
{
    public $symbolLabel = [
        '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
    ];
    public $reversedSymbolLabel = [
        '','h', 'g', 'f', 'e', 'd', 'c', 'b', 'a'
    ];
    public $y;
    public $x;
}