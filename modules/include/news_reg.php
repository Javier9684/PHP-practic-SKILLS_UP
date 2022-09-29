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
        if(!preg_match("/^[0-9]{10}+$/", $numero_telefono)) {
            return false;
        } else {
            return true;
        }
    } 

    //si llegan datos
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        print_r($_POST);
     
        if (!empty($_POST["nombre_completo"]) || !empty($_POST["email"]) || !empty($_POST["numero_telefono"])) {
            
            $nombre_completo=limpiarDatos($_POST["nombre_completo"]);
            echo "<br><strong>nombre: </strong>" . $nombre_completo . "<br>";
            $email=limpiarDatos($_POST["email"]);
            echo "<strong>email: </strong>" . $email . "<br>";
            $numero_telefono=limpiarDatos($_POST["numero_telefono"]);
            echo "<strong>telefono: </strong>" . $numero_telefono . "<br>";
            $direccion=limpiarDatos($_POST["direccion"]);
            $ciudad=limpiarDatos($_POST["ciudad"]);
            $comunidades=limpiarDatos($_POST["comunidades"]);
            $c_postal=limpiarDatos($_POST["c_postal"]);
            $check=limpiarDatos($_POST["check"]);
            $formato=limpiarDatos($_POST["formato"]);
            $mensaje=limpiarDatos($_POST["mensaje"]);
        
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