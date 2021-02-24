<?php
class padreModelo{
    public function __construct(){
    }
    
    public function conectarBaseDatos(){
        global $host_bd,$user_bd,$pass_bd,$nombre_bd;
        try {
            $bd = new PDO("mysql:host=$host_bd;dbname=$nombre_bd;charset=utf8", "$user_bd", "$pass_bd");
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bd;
        } catch (PDOException $e){
            print "<p>Error: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    public function verificarSesion(){
        if((isset($_SESSION['user_activo'])&&$_SESSION['user_activo']!='')||(isset($_GET['ruta'])&&$_GET['ruta']=='login')){
            return true;
        }else{
            return false;
        }
    }
    public function verificarPermiso($acc){
        if((isset($_SESSION['permisos'])&&$_SESSION['permisos']!='')){
            if(!isset($_GET['ruta'])){
                return true;
            }else if((isset($_GET['ruta'])&&$_GET['ruta']=="login")||(isset($_SESSION['permisos'][$_GET['ruta']]["$acc"])&&$_SESSION['permisos'][$_GET['ruta']]["$acc"]==1)){
                return true;
            }else{
                return false;
            }
        }else if(isset($_GET['ruta'])&&$_GET['ruta']=="login"){
            return true;
        }else{
            return false;
        }
    }
    public function getRol($usuario){
        global $bd;
        $result = $bd->query("SELECT u.id as id_usuario, r.id as id_rol, r.menu, r.descripcion as rol FROM usuarios u, roles r, usuarios_roles ur WHERE r.id = ur.id_rol AND ur.id_usuario = u.id AND u.usuario = '$usuario'");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function getPermisos($id_rol){
        global $bd;
        $result = $bd->query("SELECT p.ruta, p.accion FROM permisos p, permisos_rol pr WHERE p.id = pr.id_permiso AND pr.id_rol = $id_rol");
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function ejemploConsultaQuery($campo){
        global $bd;
        $result = $bd->query("SELECT campo FROM tabla t WHERE t.campo='$camppo'");
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function ejemploConsultaPrepare($campo){
        global $bd;
        $result = $bd->prepare("SELECT campo FROM tabla WHERE campo=:campo");
        $result->execute(array(":campo"=>$campo));
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
    
        return $row;
    }
}
?>
