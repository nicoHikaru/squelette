<?php

require '../vendor/autoload.php';

use Config\Bdd\Bdd;
use App\Repository\City\GetCity;

Bdd::bdd();

$city = new GetCity();

$info = $city->getCity(1);
dd($info);