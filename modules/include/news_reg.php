<?php
    require "../require/config.php";
   
    //varibles que se van a usar en el formulario
    $nombre_completo=$email=$numero_telefono=$direccion=$ciudad=$comunidades=$c_postal=$check=$formato=$mensaje="";
    $nombre_err=$email_err=$telefono_err=false;
    $checkeado;

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

            //comprobar si valida estas variables
            if (validarNombre($nombre_completo)) {
                echo "<script>console.log ('nombre es valido.')</script><br>";
            } else {
                $nombre_err=true;
            }

            if (validarEmail($email)) {
                echo "<script>console.log ('email es valido.')</script><br>";
            } else {
                $email_err=true;
            }

            if (validarTelefono($numero_telefono)) {
                echo "<script>console.log ('telefono es valido.')</script><br>";
            } else {
                $telefono_err=true;
            }

            //condicion que si no se cumple para el codigo
            if (validarNombre($nombre_completo) || validarEmail($email) || validarTelefono($numero_telefono)) {

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
                
                $check=filter_input (
                    INPUT_POST, 'check', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY
                );

                var_dump($check);
                $lengArry = count($check);
                
                switch ($lengArry) {
                    case 1:
                        if ($check[0] == "HTML") {
                                $checkeado = 100;
                        } elseif ($check[0] == "CSS") {
                                $checkeado = 010;
                        } else {
                                $checkeado = 001;
                        }
                        break;
                    case 2:
                        if ($check[0] != "HTML") {
                                $checkeado = 011;
                        } elseif ($check[0] != "CSS") {
                                $checkeado = 101;
                        } else {
                                $checkeado = 110;
                        }
                        break;
                    case 3:
                        $checkeado = 111;
                        break;
                    default:
                        $checkeado = 100;
                }

                echo "<br>Valor a devolver: <strong>" . $checkeado . " </strong>";
                
                echo "<br>";
                
                $string = implode(", ", $check);
                echo $string;
                echo "<br>";
                
                if (isset($_POST["formato"])) {
                    $formato=limpiarDatos($_POST["formato"]);
                    if ($check=="HTML") {
                        $check=0;
                    } else {    
                        $check=1;
                    }
                }
                
                if (isset($_POST["mensaje"])) {
                    $mensaje=limpiarDatos($_POST["mensaje"]);
                } else {
                    $mensaje=null;
                }

                //-------------------------BORRAR---------------------------------
                echo "<br><stronge>Nombre:</strong> $nombre_completo <br>";
                echo "<br><stronge>Email:</strong> $email <br>";
                echo "<br><stronge>Telefono:</strong> $numero_telefono <br>";
                echo "<br><stronge>Direccion:</strong> $direccion <br>";
                echo "<br><stronge>Ciudad:</strong> $ciudad <br>";
                echo "<br><stronge>Comunidades:</strong> $comunidades <br>";
                echo "<br><stronge>C.Postal:</strong> $c_postal <br>";
                echo "<br><stronge>Noticia:</strong> $check <br>";
                echo "<br><stronge>Formato:</strong> $formato <br>";
                echo "<br><stronge>Mensaje:</strong> $mensaje <br>";

                //SELECT nombre, email, telefono from news_reg WHERE $nombre_completo="nombre", $email="email", $numero_telefono="telefono";
                
                //INSERT INTO nombre, email, telefono, direccion, ciudad, comunidades, c.postal, noticia, formato, mensaje VALUES($nombre_completo, $email, $numero_telefono, $direccion, $ciudad, $comunidades, $c_postal, $checkeado, $formato, $mensaje)
            
            } else {
                if ($nombre_err==true) {
                    echo "la validacion de nombre ha fallado";
                } else if ($email_err==true) {
                    echo "la validacion de email ha fallado";
                } else if ($telefono_err==true) {
                    echo "la validacion de telefono ha fallado";
                }
            }
        } else {
            echo "uno de los datos requeridos no ha sido rellenado";
        }
    } else {
        echo "el metodo post no ha llegado";
    }
?>