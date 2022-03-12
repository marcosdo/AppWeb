<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Planificacion</title>
    </head>
    <body>
        <?php
            session_start();

            $conn = new mysqli('localhost', 'root', '', 'lifety');
            // Comprobar conexion
            if ($conn->connect_error) {
                die("fallo de conexion:" . $conn->connect_error);
            }
            
            // Obtenemos los valores del formulario
            $peso = htmlspecialchars(trim(strip_tags($_POST["peso"])));
            $altura = htmlspecialchars(trim(strip_tags($_POST["altura"])));
            $alergias = isset ($_POST["alergias"]) ? htmlspecialchars(trim(strip_tags($_POST["alergias"]))) : " ";
            $observaciones = isset ($_POST["observaciones"]) ? htmlspecialchars(trim(strip_tags($_POST["observaciones"]))) : " ";

            $sql = "SELECT * FROM profesional HAVING MIN(Num_usuarios) > -1";
            
            $resultado=$conn->query($sql);

            if($resultado->num_rows != 0){
                $row = $resultado->fetch_assoc();
                $usuarios = $row['Usuarios'].$_SESSION['nombre']." ";
                $sql = "INSERT INTO premium (Alergias, Altura, Id_profesional, Id_usuario, Logros, Num_logros, Observaciones_adicionales, Peso) VALUES ('$alergias', '$altura', '$row[Id_profesional]', '$_SESSION[id_usuario]', '0', '0', '$observaciones', '$peso')";
                if ($conn->query($sql) === TRUE) ;
                else echo "Error: " . $sql . "<br>" . $conn->error;
                $sql = "UPDATE profesional SET Usuarios = '$usuarios' , Num_usuarios = $row[Num_usuarios]+1 WHERE Id_profesional = $row[Id_profesional]";
                if ($conn->query($sql) === TRUE) ;
                else echo "Error: " . $sql . "<br>" . $conn->error;
                $sql = "UPDATE usuario SET Premium = 1 WHERE Id_usuario = $_SESSION[id_usuario]";
                if ($conn->query($sql) === TRUE) ;
                else echo "Error: " . $sql . "<br>" . $conn->error;
            }
            else {
                echo "Error en el pago";
            }
            $resultado->free();
            $conn->close();
        ?>
    </body>
</html>


