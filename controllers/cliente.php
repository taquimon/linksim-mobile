<?php
require("connection.php");
class Cliente{

    function Fixture(){
        //$this->getTable();
    }
    function getClientes(){
        $clubData = array();
		$data = array();
        $con = new Connection();
        $query = "select * from clientes";
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $clientes =  new stdClass();
			$linkCliente = "<a href='pedidos.html' data-role='button' class='ui-btn ui-mini ui-corner-all'>{$row['codigo']}</a>";
            $clientes->codigo = $linkCliente;
            $clientes->nombre = $row["nombre"];
			$clientes->direccion = $row["direccion"];
            array_push($clubData,$clientes);
        }
		$data ['User'] = $clubData;
        return $data;
    }
    function getClubNamesAjax(){
        $idCategoria = $_POST['idCategoria'];
        $idDeporte = $_POST['idDeporte'];
        echo json_encode($this->getClubNames($idDeporte, $idCategoria));
    }
    function getClubPoints($idCampeonato, $idClub){
        $clientes =  array();
        $con = new Connection();
        $query = "select distinct cp.* from partido p, club_xref_partido cp  where p.idCampeonato = {$idCampeonato} and cp.idClub = {$idClub}";
        print_r($query);
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            array_push($clientes,$row["anotacion"]);
        }
        return $clientes;
    }

}
$cliente = new Cliente;

$re = $cliente->getClientes();
echo json_encode($re);
