<?php

require_once 'vendor/autoload.php';

require_once 'TestsCases/Entity.php';
require_once 'TestsCases/User.php';

use Informations\InformationsClass;


InformationsClass::setPropertyAnnotationsClass('Informations\PropertyAnnotations');
InformationsClass::setMethodAnnotationsClass('Informations\MethodAnnotations');
InformationsClass::setClassAnnotationsClass('Informations\ClassAnnotations');
$c = new InformationsClass('Entities\User');
var_dump($c);
