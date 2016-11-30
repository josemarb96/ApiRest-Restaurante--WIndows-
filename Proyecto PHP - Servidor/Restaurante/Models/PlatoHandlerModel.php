<?php

require_once "ConsPlatoModel.php";

class PlatoHandlerModel
{
    public static function getPlato($idPlato)
    {
        $listaPlatos = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $valid = self::isValid($idPlato);

        if ($valid === true || $idPlato == null)
        {
            $query = "SELECT " . \ConstantesDB\ConsPlatoModel::ID_PLATO . ","
                . \ConstantesDB\ConsPlatoModel::NOMBRE_PLATO
                . " FROM " . \ConstantesDB\ConsPlatoModel::TABLE_NAME;


            if ($idPlato != null)
            {
                $query = $query . " WHERE " . \ConstantesDB\ConsPlatoModel::ID_PLATO . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            if ($idPlato != null)
            {
                $prep_query->bind_param('i', $idPlato);
            }

            $prep_query->execute();
            $listaPlatos = array();

            $prep_query->bind_result($idPlato, $nombrePlato);
            $prep_query->store_result();
            while ($prep_query->fetch())
            {
                $nombrePlato = utf8_encode($nombrePlato);
                $plato = new PlatoModel($idPlato,$nombrePlato);
                $listaPlatos[] = $plato;
            }
        }
        $db->closeConnection();

        return $listaPlatos;
    }

    public static function postPlato(PlatoModel $plato)
    {
        $db=DatabaseModel::getInstance();
        $connection=$db->getConnection();
        $query="insert into ". \ConstantesDB\ConsPlatoModel::TABLE_NAME.
            " (".\ConstantesDB\ConsPlatoModel::ID_PLATO.
            "," . \ConstantesDB\ConsPlatoModel::NOMBRE_PLATO.
            ") values (".$plato->getIdPlato().
            ",'".$plato->getNombrePlato()."');";
        $prep_query = $connection->prepare($query);
        $resultado=$prep_query->execute();
        $db->closeConnection();
        return $resultado;
    }

    public static function deletePlato($idPlato)
    {
        $db=DatabaseModel::getInstance();
        $connection=$db->getConnection();
        $query="delete from ". \ConstantesDB\ConsPlatoModel::TABLE_NAME." where ".\ConstantesDB\ConsPlatoModel::ID_PLATO . " = " .$idPlato;
        $prep_query = $connection->prepare($query);
        $prep_query->execute();
        $db->closeConnection();
    }

    public static function putPlato(PlatoModel $plato)
    {
        $db=DatabaseModel::getInstance();
        $connection=$db->getConnection();
        $query="update ".\ConstantesDB\ConsPlatoModel::TABLE_NAME . " set ". \ConstantesDB\ConsPlatoModel::NOMBRE_PLATO . " = '"
            .$plato->getNombrePlato() ."' where ".\ConstantesDB\ConsPlatoModel::ID_PLATO . " = " .$plato->getIdPlato();
        $prep_query = $connection->prepare($query);
        $resultado=$prep_query->execute();
        $db->closeConnection();
        return $resultado;
    }

    public static function isValid($idPlato)
    {
        $res = false;

        if (ctype_digit($idPlato))
        {
            $res = true;
        }
        return $res;
    }
}