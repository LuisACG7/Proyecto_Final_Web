<?php
require_once(__DIR__."/sistema.class.php");
   class Cita extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT c.id_cita,c.fecha,c.hora,CONCAT(cl.nombre_cliente, ' ', cl.primer_apellido, ' ', cl.segundo_apellido) AS nombre_cliente,
        s.servicio,CONCAT(e.nombre_empleado, ' ', e.primer_apellido, ' ', e.segundo_apellido) AS nombre_empleado
        FROM cita c JOIN usuario us ON c.id_usuario = us.id_usuario
        JOIN cliente cl ON cl.id_usuario = us.id_usuario
        JOIN servicio s ON c.id_servicio = s.id_servicio
        JOIN empleado e ON c.id_empleado = e.id_empleado;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_cita){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT id_cita, fecha, hora, id_usuario, id_servicio, id_empleado
      FROM cita
      where id_cita=:id_cita;");
      $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
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
         if ($this->validateCita($datos)){
            $stmt = $this->conn->prepare("INSERT INTO cita(fecha, hora, id_usuario, id_empleado, id_servicio, estado)  VALUES (:fecha, :hora, :id_usuario, :id_empleado, :id_servicio, :estado);");
            $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
            $stmt->bindParam(':hora', $datos['hora'], PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);
            $stmt->bindParam(':id_empleado', $datos['id_empleado'], PDO::PARAM_STR);
            $stmt->bindParam(':id_servicio', $datos['id_servicio'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
         return 0;
      }
  

   function delete($id_cita){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM cita
      where id_cita=:id_cita");
      $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_cita,$datos){ 
      $this->connec();
         $stmt = $this->conn->prepare("UPDATE cita SET  nombre=:nombre, primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido
         WHERE id_cita=:id_cita;");
         $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
         $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
         $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
         $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
   }

   function validateCita($datos){
      if (empty($datos['primer_apellido'])) {
         return false;
      }
      if (empty($datos['segundo_apellido'])) {
         return false;
     }
     if (empty($datos['nombre'])) {
      return false;
  }
      return true;
   }
}
?>