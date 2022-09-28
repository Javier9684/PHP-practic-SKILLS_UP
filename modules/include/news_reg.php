<?php
    require "../require/config.php";
    //varibles que se van a usar en el formulario
    $nombre_completo=$email=$numero_telefono=$direccion=$ciudad=$comunidades=$c_postal=$check=$formato=$mensaje="";
    //si llegan datos
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        //echo "<br><strong>Metodo post enviado</strong><br>";
        if (!empty($_POST["nombre_completo"]) || !empty($_POST["email"]) || !empty($_POST["numero_telefono"])) {
            echo "<br><strong>Name hay datos</strong><br>";

            $nombre_completo=$_POST["nombre_completo"]; 
            $email=$_POST["email"];
            $numero_telefono=$_POST["numero_telefono"];
            $direccion=$_POST["direccion"];
            $ciudad=$_POST["ciudad"];
            $comunidades=$_POST["comunidades"];
            $c_postal=$_POST["c_postal"];
            $check=$_POST["check"];
            $formato=$_POST["formato"];
            $mensaje=$_POST["mensaje"];
        
            function limpiarDatos($datos) {
                $datos=trim($datos);
                $datos=stripslashes($datos);
                $datos=htmlspecialchars($datos);
            }

                //nombre, email, telefono
            function validarNombre($nombre_completo) {
                if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre_completo)) {
                    return false;
                } else {
                    return true;
                }
            }  
            
            function validarEmail($email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return false;
                } else {
                    return true;
                }
            } 


            function validarTelefono($numero_telefono) {
                if(preg_match('/^[0-9]{10}+$/', $numero_telefono)) {
                    return false;
                } else {
                    return true;
                }
            } 
        }
    }
?>