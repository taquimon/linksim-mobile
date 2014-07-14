<?php
require("connection.php");
class Producto{

    function Producto(){
        //$this->getTable();
    }
    function getProductos(){
        $empresaData = array();
		$data = array();
        $con = new Connection();
        $query = "select * from Productos";
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $Productos =  new stdClass();
            $Productos->codigo = $row["codigo"];
            $Productos->nombre = $row["nombre"];
			$Productos->direccion = $row["direccion"];
            array_push($empresaData,$Productos);
        }
		$data ['User'] = $empresaData;
        return $data;
    }
    function getEmpresas(){
        $empresaData = array();
		$data = array();
        $con = new Connection();
        $query = "select * from empresa";
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $empresa =  array();
			$empresa['index'] = $row["idEmpresa"];
            $empresa['value'] = $row["nombre"];
            array_push($empresaData,$empresa);
        }

        echo json_encode($empresaData);
    }
	 function getCategorias($idEmpresa = 0){
        $categoriaData = array();
		$data = array();
        $con = new Connection();
        $query = "select * from categoria where idEmpresa={$idEmpresa}";
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $categoria =  array();
			$categoria['index'] = $row["idCategoria"];
            $categoria['value'] = $row["nombre"];
            array_push($categoriaData,$categoria);
        }

        echo json_encode($categoriaData);
    }
	function getLineas($idCategoria = 0){
        $lineaData = array();
		$data = array();
        $con = new Connection();
        $query = "select * from linea where idCategoria={$idCategoria}";
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $linea =  array();
			$linea['index'] = $row["idLinea"];
            $linea['value'] = $row["nombre"];
            array_push($lineaData,$linea);
        }

        echo json_encode($lineaData);
    }
    function getMarcas($idLinea = 0){
        $marcaData = array();
		$data = array();
        $con = new Connection();
        $query = "select * from marca where idLinea={$idLinea}";
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $marca =  array();
			$marca['index'] = $row["idMarca"];
            $marca['value'] = $row["nombre"];
            array_push($marcaData,$marca);
        }

        echo json_encode($marcaData);
    }
    function getClubPoints($idCampeonato, $idClub){
        $Productos =  array();
        $con = new Connection();
        $query = "select distinct cp.* from partido p, club_xref_partido cp  where p.idCampeonato = {$idCampeonato} and cp.idClub = {$idClub}";
        print_r($query);
        $result  = $con->queryString($query);
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            array_push($Productos,$row["anotacion"]);
        }
        return $Productos;
    }
    function callMethods(){
		if(isset($_GET['option']))
		{
			$option = $_GET["option"];
			switch ($option) {
				case 'producto':
					$this->getProductos();
					break;
				case 'empresa':
					$this->getEmpresas();
					break;
				case 'categoria':
					$idEmpresa = 0;
					if(isset($_GET['idEmpresa']))
					{
						$idEmpresa = $_GET['idEmpresa'];
					}
					$this->getCategorias($idEmpresa);
					break;
				case 'linea':
					$idCategoria = 0;
					if(isset($_GET['idCategoria']))
					{
						$idCategoria = $_GET['idCategoria'];
					}
					$this->getLineas($idCategoria);
					break;
				case 'marca':
					$idLinea = 0;
					if(isset($_GET['idLinea']))
					{
						$idLinea = $_GET['idLinea'];
					}
					$this->getMarcas($idLinea);
					break;
				default:

					break;
			}


		}
		else {
			echo "No etra";
		}
    }
}
$re = new Producto();
/*if(isset($_GET['option']))
		{
			$op = $_GET['option'];
			echo(json_encode($op));
			$re = new Producto;
		}
else{
	echo "hola";
}
	*/
$re->callMethods();

/*switch ($option) {
	case 'producto':
		$re->getProductos();
		break;
	case 'empresa':
		$re->getEmpresas();
		break;
	case 'categoria':
		$idEmpresa = 0;
		if(isset($_POST['idEmpresa']))
		{
			$idEmpresa = $_POST['idEmpresa'];
		}
		$re->getCategorias($idEmpresa);
		break;
	case 'linea':
		$re->getEmpresas();
		break;
	case 'marca':
		$re->getEmpresas();
		break;
	default:

		break;
}

*/
