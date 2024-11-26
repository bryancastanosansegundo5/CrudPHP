<?php
class Persona
{
    private $id;
    private $nombre;
    private $apellido;
    private $edad;
    private $fechaNacimiento;
    public function __construct($id = null, $nombre = null, $apellido = null, $edad = null,$fechaNacimiento=null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function getEdad(){
        return $this->edad;
    }
    public function setEdad($edad){
        $this->edad = $edad;
    }
    public function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function __toString()
    {
        return "Nombre: $this->nombre, Apellido: $this->apellido, Edad: $this->edad, fechaNacimiento: $this->fechaNacimiento";
    }


}
