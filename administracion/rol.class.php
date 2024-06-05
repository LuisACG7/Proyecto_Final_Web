<?php
require_once(__DIR__."/sistema.class.php");
   class Rol extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_rol, rol
        FROM rol");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_rol){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT  id_rol, rol
      FROM rol
      where id_rol=:id_rol;");
      $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
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
         if ($this->validateRol($datos)){
            $stmt = $this->conn->prepare("INSERT INTO rol(rol) 
                                          VALUES (:rol);");
            $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
         return 0;
      }
  

   function delete($id_rol){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM rol
      where id_rol=:id_rol");
      $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_rol,$datos){ 
      $this->connec();
         $stmt = $this->conn->prepare("UPDATE rol SET  rol=:rol
         WHERE id_rol=:id_rol;");
         $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
         $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
   }

   function validateRol($datos){
      if (empty($datos['rol'])) {
         return false;
      }
      return true;
   }
}
?>