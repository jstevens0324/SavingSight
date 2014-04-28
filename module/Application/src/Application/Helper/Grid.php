<?php

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

class Grid extends AbstractHelper
{
    public function __invoke($grid, $cols, $url) {
       return $this->getView()->render('helpers/grid', array('grid' => $grid, 'columns' => $cols, 'url' =>  $url ));
    }
}

?>
