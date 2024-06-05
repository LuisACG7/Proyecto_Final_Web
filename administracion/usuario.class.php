<?php
require_once(__DIR__."/sistema.class.php");
   class Usuario extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_usuario, correo,contrasena,token
        FROM usuario");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_usuario){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT id_usuario, correo,contrasena,token
      FROM usuario
      where id_usuario=:id_usuario;");
      $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
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
         if ($this->validateUsuario($datos)){
            $stmt = $this->conn->prepare("INSERT INTO usuario(correo,contrasena) 
                                          VALUES (:correo,:contrasena);");
            $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
         return 0;
      }
  

   function delete($id_usuario){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM usuario
      where id_usuario=:id_usuario");
      $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_usuario,$datos){ 
      $this->connec();
         $stmt = $this->conn->prepare("UPDATE usuario SET correo=:correo,contrasena=:contrasena,token=:token
         WHERE id_usuario=:id_usuario;");
         $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
         $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
         $stmt->bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
         $stmt->bindParam(':token', $datos['token'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
   }

   function validateUsuario($datos){
      if (empty($datos['correo'])) {
         return false;
      }
      if(empty($datos['contrasena'])){
        return false;
    }
      return true;
   }
}
?>