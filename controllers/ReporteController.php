<?php
@session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."/reportes/models/Reporte.php";

class ReporteController{
    //-------------------------
    public static function ejecutarAccion(){
        //Recuperamos el campo accion (es el boton Guardar)
        $accion = @$_REQUEST["action"];
        //Validamos si la accion es Guardar
        switch($accion){
            case "Guardar":
                //Invocamos el metodo guardar
                ReporteController::guardar();
                break;  
            case "Buscar":
                //Invocamos el metodo buscar
                ReporteController::buscar();
                break;
            case "Editar":
                //Invocamos el metodo buscar
                ReporteController::editar();
                break;
            case "Eliminar":
                //Invocamos el metodo eliminar
                ReporteController::eliminar();
                break;
            case "todo":
                //Invocamos el metodo listar todo
                ReporteController::listar_todo();
                break;
            case "Login":
                //Invocamos el metodo login
                ReporteController::login();
                break;
            case "Salir":
                //Invocamos el metodo salir
                ReporteController::salir();
                break;
            default:
                //Sino es la accion correcta, mandamos un error
                header("Location: ../view/error.php?msj=Accion no permitida");
                exit;    
        }
    }

    public static function guardar(){
        //Recuperar los campos enviados por el formulario
        $codigo = @$_REQUEST["codigo"];
        $password = @$_REQUEST["pass"];
        $email = @$_REQUEST["correo"];
        $tipo = @$_REQUEST["tipo"];
        $detalles = @$_REQUEST["detalles"];
        $fecha = @$_REQUEST["fecha"];
        $estado = @$_REQUEST["estado"];
        $comentarios = @$_REQUEST["comentarios"];

        // Crear una instancia (objeto) de tipo Reporte
        $u = new Reporte();
        //poner los campos como valores de las propiedades
        $u->codigo = $codigo;
        $u->password = $password;
        $u->email = $email;
        $u->tipo = $tipo;
        $u->detalles = $detalles;
        $u->fecha = $fecha;
        $u->estado = $estado;
        $u->comentarios = $comentarios;
        //Intentar guardadr el Usuario en la BD
        try{
            //Guardar el usuario
            $u->save();
            //Contar los Usuarios guardados
            $total = @Reporte::count();
            $msj = "Reporte guardado, total: $total";
            //Redireccionar a la pagina guardar enviandole un mensaje
            header("Location: ../view/reportes/agregar.php?msj=$msj");
            exit;
        }
        // Capturar algun posible error o Excepcion
        catch(Exception $error){
            //Verificar si el error es de clave primaria Duplicada
            if(strstr($error->getMessage(), "Duplicate")){
                $msj = "El Reporte con Codigo: $codigo ya existe";                
            }
            else{
                //Otro mensaje si no es error por usuario duplicado
                $msj = "Ocurrio un error al Guardar el Reporte";
            }
            //Redireccionamos a la pagina agregar con el mensaje de error
            header("Location: ../view/reportes/agregar.php?msj=$msj");
            exit;
        }
    }

    public static function buscar() {

        $codigo = $_POST["codigo"];
        try {
            $u = Reporte::find_by_pk([$codigo], []);
            if (!$u) {
                throw new Exception("Reporte no encontrado.");
            }
            $msj = "Reporte encontrado";
            header("Location: ../view/reportes/buscar.php?msj=" . urlencode($msj) . 
                "&codigo=" . urlencode($u->codigo) . 
                "&password=" . urlencode($u->password) . 
                "&email=" . urlencode($u->email) . 
                "&tipoReporte=" . urlencode($u->tipo) . 
                "&fecha=" . urlencode($u->fecha) . 
                "&detalles=" . urlencode($u->detalles) . 
                "&estado=" . urlencode($u->estado) . 
                "&comentarios=" . urlencode($u->comentarios));
            exit;
        } catch (Exception $error) {
            $msj = "Error: " . $error->getMessage();
            header("Location: ../view/reportes/buscar.php?msj=" . urlencode($msj));
            exit;
        }
    }
    

    public static function editar() {
        // Recuperar los campos enviados por el formulario
        $codigo = @$_REQUEST["codigo"];
    
        // Buscar el usuario por cédula
        $u = Reporte::find_by_pk([$codigo], []);
    
        // Verificar si el usuario existe
        if (!$u) {
            $msj = "No se encontró información del repote.";
            header("Location: ../view/reportes/buscar.php?msj=$msj");
            exit;
        }
        
        // Guardar el usuario en la sesión para su posible uso posterior
        $_SESSION["reporte.find"] = serialize($u);
    
        // Validar que la cédula consultada corresponde al usuario encontrado
        if ($u->codigo != $codigo) {
            $msj = "El codigo no corresponde al reporte consultado.";
            header("Location: ../view/reportes/buscar.php?msj=$msj");
            exit;
        }
        
        // Recuperar los campos editados en el formulario
        $email = @$_REQUEST["correo"];
        $tipoReporte = @$_REQUEST["tipoEmpleado"];
        $fechaReporte = @$_REQUEST["fechaReporte"];
        $detalles = @$_REQUEST["detalles"];
        $estado = @$_REQUEST["estado"];
        $comentarios = @$_REQUEST["comentarios"];

        // Asignar los valores al usuario
        $u->email = $email;
        $u->tipo = $tipoReporte;
        $u->fecha = $fechaReporte;
        $u->detalles = $detalles;
        $u->estado = $estado;
        $u->comentarios = $comentarios;
    
        // Intentar guardar los cambios en la BD
        try {
            $u->save();
    
            // Guardar el usuario editado en la sesión
            $_SESSION["reporte.find"] = serialize($u);
            $msj = "Reporte editado exitosamente.";
            
            // Redireccionar a la página de búsqueda con un mensaje de éxito
            header("Location: ../view/reportes/buscar.php?msj=$msj");
            exit;
        } catch (Exception $error) {
            // Verificar si el error está relacionado con una cédula inexistente
            if (strpos($error->getMessage(), 'primary') !== false) {
                $msj = "El Reporte con codigo: $codigo no existe.";
            } else {
                // Otro error al intentar editar
                $msj = "Ocurrió un error al editar el reporte: " . $error->getMessage();
            }
    
            // Limpiar el usuario de la sesión en caso de error
            $_SESSION["reporte.find"] = NULL;
            header("Location: ../view/reportes/buscar.php?msj=$msj");
            exit;
        }
    }
    
    
    public static function eliminar() {
        // Recuperar la cédula enviada por el formulario
        $codigo = @$_REQUEST["codigo"];
    
        try {
            // Intentar buscar el usuario en la base de datos por su cédula
            $u = Reporte::find_by_pk([$codigo], []);
            
            // Si el usuario no se encuentra, mostrar mensaje y redirigir
            if (!$u) {
                $msj = "No se encontró información del reporte con codigo: $codigo.";
                header("Location: ../view/reportes/buscar.php?msj=$msj");
                exit;
            }
    
            // Colocar el usuario encontrado en la sesión
            $_SESSION["reporte.find"] = serialize($u);
    
            // Obtener y deserializar el usuario desde la sesión para confirmar su eliminación
            $u = unserialize($_SESSION["reporte.find"]);
    
            // Intentar eliminar el usuario de la base de datos
            $u->delete();
    
            // Limpiar la sesión del usuario eliminado
            $_SESSION["reporte.find"] = NULL;
    
            // Contar los usuarios restantes
            $total = Reporte::count();
            $msj = "Reporte eliminado. Total de reporte restantes: $total.";
    
            // Redirigir a la página de búsqueda con mensaje de éxito
            header("Location: ../view/reportes/buscar.php?msj=$msj");
            exit;
    
        } catch (Exception $error) {
            // Verificar el tipo de error y mostrar un mensaje adecuado
            if (strstr($error->getMessage(), $codigo)) {
                $msj = "El reporte con Codigo: $codigo no existe.";
            }else {
                // Otro tipo de error
                $msj = "Ocurrió un error al eliminar el reporte: " . $error->getMessage();
            }
    
            // Limpiar la sesión en caso de error
            $_SESSION["reporte.find"] = NULL;
    
            // Redirigir con el mensaje de error
            header("Location: ../view/reportes/buscar.php?msj=$msj");
            exit;
        }
    }
    
    


    public static function listar_todo(){
        try{
            //Obtener todos los usuarios
            $reportes = Reporte::all();
            if($reportes == null){
                $_SESSION["reportes.all"]=null;
                $msj = "Total reportes: 0";
            }else{
                $total = count($reportes);
                //Serializar (convertir en texto) la lista de usuarios
                $reportes = serialize($reportes);
                //Colocamos la lista de usuarios en sesion para poder
                //recuperarla en la pagina  de reporte de usuarios
                $_SESSION["reportes.all"] = $reportes;
            }
            // redireccionamos hacia la pagina de errores 
            $msj = "Total de Reportes: $total";
            header("Location: ../view/reportes/listar_todo.php?msj=$msj");
        }catch(Exception $error){
            $_SESSION["reportes.all"]= null;
            header("Location: ../view/reportes/listar_todo.php?msj=Total de Reportes: 0");      
        }
    }


    public static function login(){
     //Recuperar los campos enviados por el formulario
     $cedula = @$_REQUEST["cc"];
     $clave = @$_REQUEST["pass"];

     //Intentar buscar el Usuario en la BD
     try{
        //Buscamos el usuario
        $u = Usuario::find($cedula);
        if($u->clave==$clave){
            $u = serialize($u);
            $_SESSION["usuario.login"] = $u;
            header("Location: ../view/usuarios/index.php");
            exit;
        }else{
            $_SESSION["usuario.login"] = null;
            header("Location: ../view/usuarios/login.php?msj=Password Incorrecto");
            exit;
        }        
     } catch(Exception $error){
        // Capturar algun posible error o Excepcion
         //Verificar si el error es que no existe
         if(strstr($error->getMessage(), $cedula)){
             $msj = "El Usuario con Cedula: $cedula no existe";                
         }
         else{
             //Otro mensaje si no es error por inexistencia
             $msj = "Ocurrio un error al Iniciar Sesion";
         }
         //Redireccionamos a la pagina login con el mensaje de error
         $_SESSION["usuario.find"] = null;
         header("Location: ../view/usuarios/login.php?msj=$msj");
         exit;
     }        
    }

    public static function salir(){        
        session_destroy();
        $msj = "Sesion cerrada";
        header("Location: ../view/usuarios/login.php?msj=$msj");
        exit;
    }
}


// Iniciamos el procesamiento de la accion
ReporteController::ejecutarAccion();

