<?php
    class DatabaseUtils {
        private $host="localhost";
        private $dbname="retrohouse";
        private $username="root";
        private $password="";

        private function obtenerConexion() : PDO {
            try {
                $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch(PDOException $e) {
                echo "La conexión falló: " . $e->getMessage();
                return null;

            }
        }

        public function insertar($query, $data) {
            try {
                $conn = $this->obtenerConexion();
                $statement = $conn->prepare($query);
                $statement->execute($data);
                return $conn->lastInsertId();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        // public function recogerColumna($query, $data){
        //     try{
        //         $conn = $this->obtenerConexion();
        //         $statement = $conn->prepare($query);
        //         $statement->execute($data);
        //         return $statement->fetchColumn();
        //     }catch(Exception $e){
        //         echo "La conexión falló: " . $e->getMessage();
        //         return null;
        //     }
        // }

  
        public function consultarListaConCondicion($query, $parametrosCondicion) {
            $conn = $this->obtenerConexion();
            $statement = $conn->prepare($query);
            $statement->execute($parametrosCondicion);
            return $statement->fetchAll();
        }


        public function actualizar($query, $data) {
            $conn = $this->obtenerConexion();

            $statement = $conn->prepare($query);
            $statement->execute($data);
            return $statement->rowCount() > 0;
        }
      }
    
?>