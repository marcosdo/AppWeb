<nav id="menu">
    <h3>Navegación</h3>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Planificacion/planificacion.php">Planificacion</a></li>
        <?php
            if(isset($_SESSION['login'])){
                if(isset($_SESSION['nutri'])) echo "<li><a href='EntrenadorPersonalEnt.php'>Nutricionista</a></li>";
                else {
                    $conn = new mysqli('localhost', 'root', '', 'lifety');
                    if ( $conn->connect_errno ) {
                        echo "Error de conexión a la BD ({$conn->connect_errno}):  {$conn->connect_error}";
                        exit();
                    }
                    if ( ! $conn->set_charset("utf8mb4")) {
                        echo "Error al configurar la BD ({$conn->errno}):  {$conn->error}";
                        exit();
                    }
                    $sql = "SELECT * FROM usuario WHERE Nombre = '$_SESSION[nombre]' AND Premium = 1";
                    $rs = $conn->query($sql);
                    if ($rs) {
                        if ($rs->num_rows != 0) echo "<li><a href='EntrenadorPersonalUsu.php'>Nutricionista</a></li>";
                        else echo "<li><a href='registronutri.php'>Nutricionista</a></li>";
                    }
                }
                $conn->close();
            }
        ?>
    </ul>
</nav>