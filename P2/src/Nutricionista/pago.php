<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Planificacion</title>
    </head>
    <body>
        <?php
            session_start();
            $_SESSION['id_usuario'] = isset($_POST["nom"]) ? $_POST["nom"] : null;

            $conn = new mysqli('localhost', 'root', '', 'lifety');
            // Comprobar conexion
            if ($conn->connect_error) {
                die("fallo de conexion:" . $conn->connect_error);
            }
            
            // Obtenemos los valores del formulario
            $peso=htmlspecialchars(trim(strip_tags($_POST["peso"])));
            $altura=htmlspecialchars(trim(strip_tags($_POST["altura"])));
            $alergias=htmlspecialchars(trim(strip_tags($_POST["alergias"])));
            $observaciones=htmlspecialchars(trim(strip_tags($_POST["observaciones"])));
            
            //cambiar tabla usuario premium a premium
            //falta id profesional
            $sql = "SELECT Id_profesional FROM profesional HAVING MIN(Num_usuarios)";
            
            $resultado=$conn->query($sql);
            $row = $resultado->fetch_assoc();

            $sql = "INSERT INTO premium (Alergias, Altura, Id_profesional, Id_usuario, Logros, Num_logros, Observaciones_adicionales, Peso) ; VALUES ('$alergias', '$altura', '$row[Id_profesional]', '$_SESSION[id_usuario]', '0', '0', '$observaciones', '$peso')";
            $resultado->free();
            if ($conn->query($sql) === TRUE) ;
            else echo "Error: " . $sql . "<br>" . $conn->error;

            $conn->close();
            header('Location: EntrenadorPersonalUsu.php');
        ?>
    </body>




</html>


