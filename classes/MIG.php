<?php

require_once 'Plane.php';

class MIG extends Plane
{
    public function attack($target){
        $target->landing();
    }
}