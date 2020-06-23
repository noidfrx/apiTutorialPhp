<?php
    //SERVICIO TIPO JSON    

    header("Access-Control-Allow-Origin: *"); //Permite leer
    header("Content-type: application/json; charset=UTF-8"); //Dice que es archivo JSON
    header("Access-Control-Allow-Methods: GET"); //Permitimos que sea tipo GET
    header("Access-Control-Allow-Credentials:true"); //Permitimos credenciales
    header("Access-Control-Allow-Headers: access"); //Para acceder al parámetro


    include_once("../config/db.php");
    include_once("../objects/productos.php");

    $database=new Conectar();
    $db=$database->conexion();

    $productos= new productos($db);

    //Para leer variables tipo GET, si puede que lo haga sino ahí muere
    $productos->id=isset($_GET["id"]) ? $_GET["id"]:die();

    //El id ya lo estamos pasando asi que no hay problema
    $productos->readOne();

    //Si hay datos se ponen en arreglo
    if($productos->name!=null){
        $productos_array=array(
            "id"=>$productos->id,
            "name"=>$productos->name,
            "description"=>$productos->description,
            "price"=>$productos->price,
            "category_id"=>$productos->category_id,
            "category_name"=>$productos->category_name,
        );

        http_response_code(200);
        echo json_encode($productos_array);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message"=>"No existe producto"));
    }
?>