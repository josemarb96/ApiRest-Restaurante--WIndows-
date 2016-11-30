<?php

class PlatoModel implements JsonSerializable
{
    private $idPlato;
    private $nombrePlato;

    public function __construct($idPlato,$nombrePlato)
    {
        $this->idPlato = $idPlato;
        $this->nombrePlato = $nombrePlato;
    }

    public function getIdPlato()
    {
        return $this->idPlato;
    }

    public function getNombrePlato()
    {
        return $this->nombrePlato;
    }

    public function setIdPlato($idPlato)
    {
        $this->idPlato = $idPlato;
    }

    public function setNombrePlato($nombrePlato)
    {
        $this->nombrePlato = $nombrePlato;
    }

    function jsonSerialize()
    {
        return array
        (
            'idPlato' => $this->idPlato,
            'nombrePlato' => $this->nombrePlato
        );
    }

    public function __sleep()
    {
        return array('idPlato' , 'nombrePlato');
    }
}