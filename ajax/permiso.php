<?php

require_once "../modelos/Permiso.php";

$permiso = new Permiso();

switch ($_GET["op"]) {
    
    case 'listar':
        $rspta = $permiso->listar();
        //Codificar el resultado usando JSON
        $data = Array();

        while ($reg=$rspta->fetch_object()) {
            $data[]=array(
                "0"=>$reg->nombre
            );
        }
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=> count($data), // Enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), // Enviamos el total de registros a visualizar
            "aaData"=> $data);
        echo json_encode($results); 
        
        break;


}

?>