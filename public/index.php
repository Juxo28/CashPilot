<?php

require_once "../class/Persona.php";

$persona1 = new Persona ("Julian","Palacio","21","3247903417","julianpalaciol2804@gmail.com");
$persona2 = new Persona ("Camila","Gomez","23","3204567891","camila.gomez23@gmail.com");
$persona3 = new Persona ("Sebastian","Martinez","27","3119876543","sebastian.martinez27@gmail.com");

$persona1->setNombre("David");
$persona1->setApellido("Latorre");
$persona1->setEdad("23");
$persona1->setTelefono("3247903417");
$persona1->setCorreo("DavidLatorre@gmail.com");


echo $persona1->saludar();
echo $persona2->saludar();
echo $persona3->saludar();

echo $persona1->getNombre();
echo "<br>";
echo $persona2->getEdad();
echo "<br>";
echo $persona3->getApellido();