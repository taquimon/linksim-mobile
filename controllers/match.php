<?php
require("connection.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Match {

    private $con;

    function Match(){
        $this->con = new Connection();
    }
    function getMatchesByPartido($date, $idPartido = 0){
        $iniTime = '00:00:00';
        $endTime = '23:59:59';

        $matches =  array();

        $query = "select * from club_xref_partido where fechaPartido between '{$date} {$iniTime}' and '{$date} {$endTime}' and idPartido={$idPartido} order by fechaPartido";
        $result  = $this->con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $match = array();
            array_push($match, $row["fechaPartido"]);
            array_push($match, $this->getClub($row["idClub"]));
            array_push($match, $row["anotacion"]);
            array_push($match, $row["idResultado"]);
            array_push($matches, $match);
        }
        return $matches;
    }
    function getClub($idClub){
        $query = "select * from club where idClub = ". $idClub;
        $result  = $this->con->queryString($query);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);

        return $row['name'];
    }
    function getMatches($date, $idCamp = 0){
        $iniTime = '00:00:00';
        $endTime = '23:59:59';

        $matches =  array();

        $query = "select * from partido where fecha between '{$date} {$iniTime}' and '{$date} {$endTime}' and idCampeonato = {$idCamp} order by fecha";
        $result  = $this->con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $match = array();
            array_push($match, $row["idPartido"]);
            array_push($match, $row["idCampeonato"]);
            array_push($match, $row["fecha"]);
            array_push($matches, $match);
        }
        return $matches;

    }

}
