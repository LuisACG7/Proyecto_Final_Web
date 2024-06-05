<?php
require_once(__DIR__."/sistema.class.php");
   class Corte extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_catalogo, nombre, descripcion, fotografia
        FROM catalogo_cortes;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_catalogo){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT id_catalogo, nombre, descripcion, fotografia 
      FROM catalogo_cortes
      where id_catalogo=:id_catalogo;");
      $stmt->bindParam(':id_catalogo', $id_catalogo, PDO::PARAM_INT);
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
      $nombre_archivo = $this->upload("cortes");
      if ($nombre_archivo){
         if ($this->validateCatalogo($datos)){
            $stmt = $this->conn->prepare("INSERT INTO catalogo_cortes(nombre, descripcion, fotografia) 
                                          VALUES (:nombre, :descripcion, :fotografia);");
            $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
      }
      else{
         $stmt = $this->conn->prepare("INSERT INTO catalogo_cortes(nombre, descripcion) 
                                       VALUES (:nombre, :descripcion);");
         $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
         $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
      }
      return 0;
   }

   function delete($id_catalogo){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM catalogo_cortes
      where id_catalogo=:id_catalogo;");
      $stmt->bindParam(':id_catalogo', $id_catalogo, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_catalogo,$datos){ 
      $this->connec();
      $nombre_archivo = $this->upload("cortes");
      if($nombre_archivo){
         $stmt = $this->conn->prepare("UPDATE catalogo_cortes SET nombre=:nombre, descripcion=:descripcion, fotografia=:fotografia
         WHERE id_catalogo=:id_catalogo;");
         $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
      }
      else {
         $stmt = $this->conn->prepare("UPDATE catalogo_cortes SET nombre=:nombre, descripcion=:descripcion
         WHERE id_catalogo=:id_catalogo;");
      }

      $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
      $stmt->bindParam(':id_catalogo', $id_catalogo, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function validateCatalogo($datos){
      if (empty($datos['nombre'])) {
         return false;
      }
      if (empty($datos['descripcion'])) {
        return false;
    }
      return true;
   }
}
?>