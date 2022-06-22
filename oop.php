<?php
require_once 'classes/MIG.php';
require_once 'classes/TU154.php';
require_once('classes/Airport.php');

$tu_154 = new TU154("Стриж", 100);
$airport1 = new Airport([], 'Camchatka', 10);
$airport1->takePlane($tu_154);
$airport1->planeParking("Стриж");
$airport1->planeReadyToTakeOff("Стриж");
$airport1->planeRepair("Стриж");
$airport1->planeRepaired("Стриж");
$airport1->printAllPlanes();
$airport1->planeFlewAway("Стриж");
$airport1->printAllPlanes();
