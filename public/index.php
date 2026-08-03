<?php

require_once "../class/Persona.php";

$persona1 = new Persona ("Julian","Palacio","21","3247903417","julianpalaciol2804@gmail.com");


$persona1->setNombre("David");
$persona1->setApellido("Latorre");
$persona1->setEdad(26);



echo $persona1->saludar();


