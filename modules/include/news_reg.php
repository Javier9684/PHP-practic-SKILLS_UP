<?php
    require "../require/config.php";
   
    //varibles que se van a usar en el formulario
    $nombre_completo=$email=$numero_telefono=$direccion=$ciudad=$comunidades=$c_postal=$check=$formato=$mensaje="";

    function limpiarDatos($datos) {
        $datos=trim($datos);
        $datos=stripslashes($datos);
        $datos=htmlspecialchars($datos);
        return $datos;
    } 

     //nombre, email, telefono (validaciones)
     function validarNombre($nombre_completo) {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nombre_completo)) {
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
        if(!preg_match("/^[0-9]{9}+$/", $numero_telefono)) {
            return false;
        } else {
            return true;
        }
    } 

    //si llegan datos
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        print_r($_POST);
        //variables requeridas para enviar a BBDD
        if (!empty($_POST["nombre_completo"]) || !empty($_POST["email"]) || !empty($_POST["numero_telefono"])) {

            $nombre_completo=limpiarDatos($_POST["nombre_completo"]);
            $email=limpiarDatos($_POST["email"]);
            $numero_telefono=limpiarDatos($_POST["numero_telefono"]);
            echo "<br><strong>Nombre: </strong>" . $nombre_completo . "<br>";
            echo "<strong>Email: </strong>" . $email . "<br>";
            echo "<strong>Telefono: </strong>" . $numero_telefono . "<br>";

            if (isset($_POST["direccion"])) {
                $direccion=limpiarDatos($_POST["direccion"]);
            } else {
                $direccion=null;
            }
            if (isset($_POST["ciudad"])) {
                $ciudad=limpiarDatos($_POST["ciudad"]);
            } else {
                $ciudad=null;
            }
            if (isset($_POST["comunidades"])) {
                $comunidades=limpiarDatos($_POST["comunidades"]);
            } else {
                $comunidades=null;
            }
            if (isset($_POST["c_postal"])) {
                $c_postal=limpiarDatos($_POST["c_postal"]);
            } else {
                $c_postal=null;
            }
            if (isset($_POST["check"])) {
                $check=limpiarDatos($_POST["check"]);
            } else {
                $check=null;
            }
            if (isset($_POST["formato"])) {
                $formato=limpiarDatos($_POST["formato"]);
            } else {
                $formato=null;
            }
            if (isset($_POST["mensaje"])) {
                $mensaje=limpiarDatos($_POST["mensaje"]);
            } else {
                $mensaje=null;
            }
            
            //comprobar si valida estas variables
            if (validarNombre($nombre_completo)) {
                echo "validado";
            } else {
                echo "no valida";
            }

            if (validarEmail($email)) {
                echo "validado";
            } else {
                echo "no valida";
            }

            if (validarTelefono($numero_telefono)) {
                echo "validado";
            } else {
                echo "no valida";
            }
        }
    }
?>