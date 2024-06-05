<?php
require_once(__DIR__."/sistema.class.php");
   class Cliente extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_cliente, nombre_cliente, primer_apellido, segundo_apellido
        FROM cliente");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_cliente){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT  id_cliente, nombre_cliente, primer_apellido, segundo_apellido
      FROM cliente
      where id_cliente=:id_cliente;");
      $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
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
         if ($this->validateCliente($datos)){
            $stmt = $this->conn->prepare("INSERT INTO cliente(primer_apellido, segundo_apellido, nombre_cliente) 
                                          VALUES (:primer_apellido, :segundo_apellido, :nombre_cliente);");
            $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':nombre_cliente', $datos['nombre_cliente'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
         return 0;
      }
  

   function delete($id_cliente){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM cliente
      where id_cliente=:id_cliente");
      $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_cliente,$datos){ 
      $this->connec();
         $stmt = $this->conn->prepare("UPDATE cliente SET  nombre_cliente=:nombre_cliente, primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido
         WHERE id_cliente=:id_cliente;");
         $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
         $stmt->bindParam(':nombre_cliente', $datos['nombre_cliente'], PDO::PARAM_STR);
         $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
         $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
   }

   function validateCliente($datos){
      if (empty($datos['primer_apellido'])) {
         return false;
      }
      if (empty($datos['segundo_apellido'])) {
         return false;
     }
     if (empty($datos['nombre_cliente'])) {
      return false;
  }
      return true;
   }
}
?>