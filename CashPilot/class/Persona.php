<?php
class Persona
{
    private $nombre;
    private $apellido;
    private $edad;
    private $telefono;
    private $correo;

    public function __construct($nombre,$apellido,$edad,$telefono,$correo)
    {
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->edad=$edad;
        $this->telefono=$telefono;
        $this->correo=$correo;
    }

    public function setNombre ($nombre)
    {
        if (is_string($nombre) && trim($nombre) !== "" ){
            $this->nombre = $nombre;
        }
           
    }

    public function setApellido ($apellido)
    {
        if (is_string($apellido) && trim ($apellido) !==""){
            $this->apellido = $apellido;
            }
    }

    public function setEdad ($edad)
    {
       if (is_numeric($edad) && $edad > 0 && $edad <= 120) {
            $this->edad=$edad;
            }
    }

    public function setTelefono ($telefono)
    {
        $this->telefono=$telefono;
    }

    public function setCorreo ($correo)
    {
        $this->correo=$correo;
    }

   public function saludar() 
    {
        return "Hola, mi nombre es: ".$this->nombre ." ".$this->apellido . ", mi correo es: " .$this->correo. " tengo " .$this->edad. " años". " y mi telefono es: " .$this->telefono. "<br>";
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getCorreo(){
        return $this->correo;
    }

}
?>