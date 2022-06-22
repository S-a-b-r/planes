<?php

require_once 'Plane.php';

//type = Агрегация
class Airport
{
    private $planes = [];
    private $countHangars;
    private $repairCenter = [];
    private $name;

    public function __construct(array $planes, $name, $countHangars){
        foreach ($planes as $plane){
            $this->planes[] = $plane;
        }
        $this->name = $name;
        $this->countHangars = $countHangars;
    }

    public function takePlane(Plane $plane){
        $planeIdx = $this->isPlaneInAirport($plane);
        if(($planeIdx === null) && ($this->countFreeHangars() > 0)){
            $this->planes[] = $plane;
            $this->planes[count($this->planes) - 1 ]->landing();
            echo "Самолет ". $plane->getName() ." успешно приземлился в аэропорту ". $this->name." <br/>";
        }else if($this->countFreeHangars() < 1){
            echo "В аэропорту недостаточно мест<br/>";
        }
        else{
            echo "Самолет уже находится в аэропорту<br/>";
        }
    }

    public function planeFlewAway(string $planeName){
        $numberPlane = $this->getIndexPlaneByName($planeName);
        if($numberPlane === null){
            echo('Cамолет не находится в аэропорту <br/>');
        }
        else{
            $this->planes[$numberPlane]->takeoff();
            echo "Самолет ".$planeName." улетел из аэропорта ".$this->name."<br/>" ;
            array_splice($this->planes, $numberPlane, 1);
        }
    }

    public function planeParking(string $planeName){
        $numberPlane = $this->getIndexPlaneByName($planeName);
        if($numberPlane === null){
            echo('Cамолет не находится в аэропорту<br/>');
        }
        else if($this->countFreeHangars() < 1){
            echo "Нет свободных мест в ангаре<br/>";
        }
        else {
            $this->planes[$numberPlane]->landing();
            echo("Самолет ". $this->planes[$numberPlane]->getName() ." остановился в аэропорту ". $this->name ."<br/>");
        }
    }

    public function planeReadyToTakeOff(string $planeName){
        $numberPlane = $this->getIndexPlaneByName($planeName);
        if($numberPlane === null){
            echo('Самолет не находится в аэропорту<br/>');
        }
        else{
            echo "Самолет ". $this->planes[$numberPlane]->getName()." вышел на взлетную полосу<br/>";
        }
    }

    public function planeRepair(string $planeName){
        $numberPlane = $this->getIndexPlaneByName($planeName);
        if($numberPlane === null){
            echo('Самолет не находится в аэропорту<br/>');
        }
        else{
            $this->repairCenter[] = $this->planes[$numberPlane];
            array_splice($this->planes, $numberPlane, 1);
            echo "Самолет отправился на ремонт<br/>";
        }
    }

    public function planeRepaired($planeName){
        $numberPlane = $this->isPlaneInRepairByName($planeName);
        if($this->countFreeHangars() < 1){
            echo "В ангаре не хватает места, чтобы самолет покинул ремонтный центр<br/>";

        }else if($numberPlane === null){
            echo "Самолет не в ремонте<br/>";
        }
        else{
            $this->planes[] = $this->repairCenter[$numberPlane];
            array_splice($this->repairCenter, $numberPlane, 1);
            echo "Самолет закончил ремонтироваться<br/>";
        }
    }

    public function printAllPlanes(){
        foreach ($this->planes as $plane){
            echo $plane->getName().'<br/>';
        }
        if(count($this->planes)==0){
            echo "В аэропорту самолетов нет";
        }
    }

    private function isPlaneInAirport(Plane $plane){
        for($i = 0; $i < count($this->planes); $i++){
            if( strcmp($plane->getName(),$this->planes[$i]->getName()) == 0){
                return $i;
            }
        }
        return null;
    }

    private function isPlaneInRepairByName(string $planeName){
        for($i = 0; $i < count($this->repairCenter); $i++){
            if(strcmp($planeName, $this->repairCenter[$i]->getName()) == 0){
                return $i;
            }
        }
        return null;
    }

    private function getIndexPlaneByName(string $planeName){
        for($i = 0; $i < count($this->planes); $i++){
            if(strcmp($planeName, $this->planes[$i]->getName()) == 0){
                return $i;
            }
        }
        return null;
    }

    public function countFreeHangars(){
        return $this->countHangars - count($this->planes);
    }
}