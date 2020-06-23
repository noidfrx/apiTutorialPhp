<?php 

    class productos{
        
        private $conn; //Para conexión

        //Para objetos devueltos de la bd
        private $tabla="products";
        public $id;
        public $name;
        public $description;
        public $price;
        public $category_id;
        public $category_name;
        public $created;

        //Constructor de clase productos: Lo que nos pasen de db, se lo vamos a pasar a "conn"
        public function __construct($db){
            $this->conn=$db;

        }

        //Para CRUD de servicios
        public function read(){

            //Consulta anidada FK y PK
            $query="SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM ".$this->tabla." p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.created DESC";

            $consulta = $this->conn->prepare($query);
            $consulta->execute();

            return $consulta;

        }

        //Para leer solo 1 dato por id
        public function readOne(){
            $query="SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM ".$this->tabla." p LEFT JOIN categories c ON p.category_id=c.id WHERE p.id=? limit 0,1";

            $consulta = $this->conn->prepare($query);
            
            //Pasamos parámetro "?"
            $consulta->bindParam(1,$this->id);
            $consulta->execute();

            if($consulta->rowCount()>0){
                $row=$consulta->fetch(PDO::FETCH_ASSOC);
                $this->name=$row["name"];
                $this->price=$row["price"];
                $this->description=$row["description"];
                $this->category_id=$row["category_id"];
                $this->category_name=$row["category_name"];
            }
        }






    }

?>