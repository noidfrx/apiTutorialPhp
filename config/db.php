
<?php
// <!-- Archivo para conectarse a la base de datos -->
include("configure.php");

class Conectar
{
    //Atributos
    private $hostName;
    private $usuario;
    private $clave;
    private $dbName;
    protected $connect;//Para llamar a bd

    //Constructor (Inicializamos los atributos)
    public function __construct()
    {
        $this->hostName=HOSTNAME;
        $this->usuario=USUARIO;
        $this->clave=CLAVE;
        $this->dbName=DBNAME;
    }

    //Funciones

    //Se realiza conexión a base de datos
    public function conexion(){
        //Usamos PDO para conectar a bd
        $this->connect=new PDO("mysql:host=".$this->hostName.";dbname=".$this->dbName, $this->usuario, $this->clave);
        try{
            $this->connect->exec("SET NAMES UTF-8");

        }catch(PDOException $exception){
            echo "Error: ".$exception->getMessage();
        }
        return $this->connect;
    }
}

?>