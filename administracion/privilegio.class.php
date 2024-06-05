<?php
require_once(__DIR__."/sistema.class.php");
   class Privilegio extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_privilegio, privilegio
        FROM privilegio");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_privilegio){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT  id_privilegio, privilegio
      FROM privilegio
      where id_privilegio=:id_privilegio;");
      $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $datos=array();
      $datos=$stmt->fetchAll();
      if (isset($datos[0])) {
         $this->SetCount(count($datos));
         return $datos[0];
      }
      return array();
   }

   function insert($datos){
      $this->connec();
         if ($this->validatePrivilegio($datos)){
            $stmt = $this->conn->prepare("INSERT INTO privilegio(privilegio) 
                                          VALUES (:privilegio);");
            $stmt->bindParam(':privilegio', $datos['privilegio'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
         return 0;
      }
  

   function delete($id_privilegio){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM privilegio
      where id_privilegio=:id_privilegio");
      $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_privilegio,$datos){ 
      $this->connec();
         $stmt = $this->conn->prepare("UPDATE privilegio SET  privilegio=:privilegio
         WHERE id_privilegio=:id_privilegio;");
         $stmt->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
         $stmt->bindParam(':privilegio', $datos['privilegio'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
   }

   function validatePrivilegio($datos){
      if (empty($datos['privilegio'])) {
         return false;
      }
      return true;
   }
}
?>