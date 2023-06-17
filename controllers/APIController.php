<?Php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{
    public static function index(){
       $servicios = Servicio::all();
      echo json_encode($servicios);
    }
    public static function guardar(){

      $cita = new Cita($_POST);
      $resultado = $cita->guardar();
      $id = $resultado['id'];
      //Seperar los servicios
      $idServicios = explode(",", $_POST['servicios']);

      foreach($idServicios as $idServicio){
        $args = [
          'citasId'=> $id,
          'servicioId'=> $idServicio
        ];
        $citaServicio = new CitaServicio($args);
        $citaServicio->guardar();
      }
      //almacena la cita y los servicios
     
      echo json_encode(['resultado'=> $resultado]);
    }
    public static function eliminar(){
      if($_SERVER['REQUEST_METHOD']==='POST'){
        $cita = Cita::find($_POST['id']);
        $cita->eliminar();
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
    }
}

?>