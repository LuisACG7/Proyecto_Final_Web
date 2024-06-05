<?php
require_once(__DIR__."/sistema.class.php");
   class Servicio extends Sistema {
    function getAll(){
        $this->connec();
        $stmt = $this->conn->prepare("SELECT id_servicio, servicio, descripcion, duracion, precio, fotografia 
        FROM servicio");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
        $this->SetCount(count($datos));
        return $datos;
   }

   function getOne($id_servicio){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT id_servicio, servicio, descripcion, duracion, precio, fotografia 
      FROM servicio
      where id_servicio=:id_servicio;");
      $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
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

// obtener todos los comentarios de 1 servicio
   function getComentarios($id_servicio){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT c.*, cli.nombre_cliente
      FROM comentarios c
      INNER JOIN cliente cli ON c.id_usuario = cli.id_usuario 
      where c.id_servicio=:id_servicio;");
      $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $datos=array();
      $datos=$stmt->fetchAll();
      if (isset($datos)) {
         $this->SetCount(count($datos));
         return $datos;
      }
      return array();


   }

// obtener todas las citas existentes para 1 servicio en  1 dia seleccionado
   function getCitasExistentes($id_servicio, $fecha){
      $this->connec();

      $stmt = $this->conn->prepare("SELECT hora FROM cita  where id_servicio=:id_servicio AND fecha=:fecha;");
      $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_STR);
      $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $datos=array();
      $datos=$stmt->fetchAll();
      if (isset($datos)) {
         $this->SetCount(count($datos));
         return $datos;
      }
      return array();


   }

// obtener horarios del dia
   function getHorarios($dia_de_semana){
      $this->connec();
      $stmt = $this->conn->prepare("SELECT * 
      FROM horarios
      where id_horario=:dia_de_semana;");
      $stmt->bindParam(':dia_de_semana', $dia_de_semana, PDO::PARAM_INT);
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


// funcion para  Crear Cita
   function crearCita($datos){
      $this->connec();

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


// funcion para  Crear comentario
   function crearComentario($datos){
      $this->connec();

      $stmt = $this->conn->prepare("INSERT INTO comentarios(id_usuario, comentario, id_servicio)  VALUES (:id_usuario, :comentario, :id_servicio);");
 
      $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);
      $stmt->bindParam(':comentario', $datos['comentario'], PDO::PARAM_STR);
      $stmt->bindParam(':id_servicio', $datos['id_servicio'], PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->rowCount();

   }


   function insert($datos){
      $this->connec();
      $nombre_archivo = $this->upload("servicios");
      if ($nombre_archivo){
         if ($this->validateServicio($datos)){
            $stmt = $this->conn->prepare("INSERT INTO servicio(servicio, descripcion, duracion, precio, fotografia) 
                                          VALUES (:servicio, :descripcion, :duracion, :precio, :fotografia);");
            $stmt->bindParam(':servicio', $datos['servicio'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':duracion', $datos['duracion'], PDO::PARAM_INT);
            $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
         }
      }
      else{
         $stmt = $this->conn->prepare("INSERT INTO servicio(servicio, descripcion, duracion, precio) 
                                       VALUES (:servicio, :descripcion, :duracion, :precio);");
         $stmt->bindParam(':servicio', $datos['servicio'], PDO::PARAM_STR);
         $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
         $stmt->bindParam(':duracion', $datos['duracion'], PDO::PARAM_INT);
         $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
         $stmt->execute();
         return $stmt->rowCount();
      }
      return 0;
   }

   function delete($id_servicio){
      $this->connec();
      $stmt = $this->conn->prepare("DELETE FROM servicio
      where id_servicio=:id_servicio;");
      $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function update($id_servicio,$datos){ 
      $this->connec();
      $nombre_archivo = $this->upload("servicios");
      if($nombre_archivo){
         $stmt = $this->conn->prepare("UPDATE servicio SET servicio=:servicio, descripcion=:descripcion, duracion=:duracion, precio=:precio, fotografia=:fotografia
         WHERE id_servicio=:id_servicio;");
         $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
      }
      else {
         $stmt = $this->conn->prepare("UPDATE servicio SET servicio=:servicio, descripcion=:descripcion, duracion=:duracion, precio=:precio
         WHERE id_servicio=:id_servicio;");
      }

      $stmt->bindParam(':servicio', $datos['servicio'], PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
      $stmt->bindParam(':duracion', $datos['duracion'], PDO::PARAM_INT);
      $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
      $stmt->bindParam(':id_servicio', $id_servicio, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->rowCount();
   }

   function validateServicio($datos){
      if (empty($datos['servicio'])) {
         return false;
      }
      if (empty($datos['precio'])) {
        return false;
    }
      return true;
   }
}
?>