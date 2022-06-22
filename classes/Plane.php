<?php

abstract class Plane
{
    protected $name;
    protected $max_speed;
    protected $position = 'land';

    public function __construct($name, $max_speed){
        $this->name = $name;
        $this->max_speed = $max_speed;
    }

    public function getPosition(){
        return $this->position;
    }

    public function getName(){
        return $this->name;
    }

    public function takeoff(){
        $this->position = 'air';
        echo "Самолет ".$this->name." взлетает <br/>";
    }

    public function landing(){
        $this->position = 'land';
        echo "Самолет ".$this->name." приземляется<br/>";
    }
}