<?php
require_once(__DIR__."/sistema.class.php");
   class Empleado extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_empleado, nombre_empleado, primer_apellido, segundo_apellido, puesto
        FROM empleado");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_empleado){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT  id_empleado, nombre_empleado, primer_apellido, segundo_apellido, puesto
      FROM empleado
      where id_empleado=:id_empleado;");
      $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
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
      $this->conn->query("set names utf8;");
      $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      if ($this->validateEmpleado($datos)){
            $stmt = $this->conn->prepare("INSERT INTO empleado(nombre_empleado, primer_apellido, segundo_apellido, puesto) 
                                          VALUES (:nombre_empleado, :primer_apellido, :segundo_apellido, :puesto);");
            $stmt->bindParam(':nombre_empleado', $datos['nombre_empleado'], PDO::PARAM_STR);
            $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':puesto', $datos['puesto'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
      return 0;
  }
  

   function delete($id_empleado){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM empleado
      where id_empleado=:id_empleado");
      $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_empleado,$datos){ 
      $this->connec();
         $stmt = $this->conn->prepare("UPDATE empleado SET  nombre_empleado=:nombre_empleado, primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido, puesto=:puesto
         WHERE id_empleado=:id_empleado;");
         $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
         $stmt->bindParam(':nombre_empleado', $datos['nombre_empleado'], PDO::PARAM_STR);
         $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
         $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
         $stmt->bindParam(':puesto', $datos['puesto'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
   }

   function validateEmpleado($datos){
      if (empty($datos['nombre_empleado'])) {
         return false;
      }
      if (empty($datos['puesto'])) {
         return false;
     }
      return true;
   }
}
?>