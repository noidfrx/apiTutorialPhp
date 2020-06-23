<?php
    //SERVICIO tipo JSON

    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=UTF-8");

    include_once("../config/db.php");
    include_once("../objects/productos.php");

    $database = new Conectar();
    $db=$database->conexion();

    $producto = new productos($db);
    $consulta=$producto->read(); // Se almacena consulta
    $num=$consulta->rowCount(); // Almacena el número de filas guardadas


    //Si hay valores se recorre el registro
    if($num>0){

        $producto_array=array(); // Arreglo para almacenar productos
        $producto_array["records"]=array(); // Arreglo dentro de arreglo
        //Se obtiene datos de consulta
        while($fila=$consulta->fetch(PDO::FETCH_ASSOC)){
            extract($fila);
            
            // Se arma estructura de un JSON / html entity decode transforma a UTF 8 lo que recibe
            $producto_item=array("id"=>$id,"name"=>$name,"description"=>html_entity_decode($description),"price"=>$price,"category_id"=>$category_id,"category_name"=>$category_name);

            array_push($producto_array["records"],$producto_item);
            
            //Cuando hayan datos: código 200
            http_response_code(200);

            echo json_encode($producto_array);
        }


    }
    else{
        //Si no hay datos
        http_response_code(404);
    }
?>