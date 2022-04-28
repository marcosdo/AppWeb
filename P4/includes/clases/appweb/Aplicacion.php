<?php

namespace appweb;

use appweb\usuarios\Usuario;
use appweb\usuarios\Personas;

/** Clase que mantiene el estado global de la aplicación. */
class Aplicacion {
    // ==================== CONSTANTES ====================
    // ====================           ====================
    const ATRIBUTOS_PETICION = 'attsPeticion';

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    /** @var Aplicacion Instancia de Aplicacion */
    private static $instancia;
    /** @var array Almacena los datos de configuración de la BD */
    private $bdDatosConexion;
    /** @var string Ruta donde se encuentra instalada la aplicación. Por ejemplo, si la aplicación está accesible en http://localhost/miApp/, este parámetro debería de tomar el valor "/miApp". */
    private $rutaApp;
    /** @var string Ruta absoluta al directorio "includes" de la aplicación. */
    private $dirInstalacion;
    /** @var boolean Almacena si la Aplicacion ya ha sido inicializada. */
    private $inicializada;
    /** @var boolean Almacena si la Aplicacion está generando una página de error */
    private $generandoError;
    /** @var \mysqli Conexión de BD. */
    private $conn;
    /** @var array Tabla asociativa con los atributos pendientes de la petición. */
    private $atributosPeticion;

    // ==================== METODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    private function __construct() {
        $this->inicializada = false;
        $this->generandoErro = false;
    }

    // Getters y setters
    /**
     * Devuelve una conexión a la BD. Se encarga de que exista como mucho una conexión a la BD por petición.
     * @return \mysqli Conexión a MySQL.
     */
    public function getConexionBd() {
        $this->compruebaInstanciaInicializada();
        if (!$this->conn) {
            $bdHost = $this->bdDatosConexion['localhost'];
            $bdUser = $this->bdDatosConexion['lifetyuser'];
            $bdPass = $this->bdDatosConexion['lifetypass'];
            $bd = $this->bdDatosConexion['lifety'];

            $conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
            if ($conn->connect_errno) {
                echo "Error de conexión a la BD ({$conn->connect_errno}):  {$conn->connect_error}";
                exit();
            }
            if (!$conn->set_charset("utf8mb4")) {
                echo "Error al configurar la BD ({$conn->errno}):  {$conn->error}";
                exit();
            }
            $this->conn = $conn;
        }
        return $this->conn;
    }
    /**
     * Devuelve un atributo establecido en la petición actual o en la petición justamente anterior.
     * @param string $clave Clave sobre la que buscar el atributo.
     * @return any Attributo asociado a la sesión bajo la clave <code>$clave</code> o <code>null</code> si no existe.
     */
    public function getAtributoPeticion($clave) {
        $result = $this->atributosPeticion[$clave] ?? null;
        if (is_null($result) && isset($_SESSION[self::ATRIBUTOS_PETICION])) {
            $result = $_SESSION[self::ATRIBUTOS_PETICION][$clave] ?? null;
        }
        return $result;
    }

    /**
     * Inicializa la aplicación.
     *
     * Opciones de conexión a la BD:
     * <table>
     *   <thead>
     *     <tr>
     *       <th>Opción</th>
     *       <th>Descripción</th>
     *     </tr>
     *   </thead>
     *   <tbody>
     *     <tr>
     *       <td>host</td>
     *       <td>IP / dominio donde se encuentra el servidor de BD.</td>
     *     </tr>
     *     <tr>
     *       <td>bd</td>
     *       <td>Nombre de la BD que queremos utilizar.</td>
     *     </tr>
     *     <tr>
     *       <td>user</td>
     *       <td>Nombre de usuario con el que nos conectamos a la BD.</td>
     *     </tr>
     *     <tr>
     *       <td>pass</td>
     *       <td>Contraseña para el usuario de la BD.</td>
     *     </tr>
     *   </tbody>
     * </table>
     *
     * @param array $bdDatosConexion datos de configuración de la BD.
     *
     * @param string $rutaApp (opcional) Ruta donde se encuentra instalada la aplicación.
     *                            Por ejemplo, si la aplicación está accesible en
     *                            http://localhost/miApp/, este parámetro debería de tomar el
     *                            valor "/miApp".
     * @param string $dirInstalacion (opcional) Ruta absoluta al directorio "includes" de la
     *                               aplicación.
     *
     */
    public function init($bdDatosConexion, $rutaApp = '/', $dirInstalacion = __DIR__) {
        if (!$this->inicializada) {
            $this->bdDatosConexion = $bdDatosConexion;
            $this->rutaRaizApp = $rutaApp;
            // Eliminamos la última '/'
            $tamRutaRaizApp = mb_strlen($this->rutaRaizApp);
            if ($tamRutaRaizApp > 0 && mb_substr($this->rutaRaizApp, $tamRutaRaizApp-1, 1) === '/') {
                $this->rutaRaizApp = mb_substr($this->rutaRaizApp, 0, $tamRutaRaizApp - 1);
            }
            // El último separador de la ruta (ya sea el separador específico del sistema o '/')
            $this->dirInstalacion = $dirInstalacion;
            $tamDirInstalacion = mb_strlen($this->dirInstalacion);
            if ($tamDirInstalacion > 0) {
                $ultimoChar = mb_substr($this->dirInstalacion, $tamDirInstalacion-1, 1);
                if ($ultimoChar === DIRECTORY_SEPARATOR || $ultimoChar === '/') {
                    $this->dirInstalacion = mb_substr($this->dirInstalacion, 0, $tamDirInstalacion - 1);
                }
            }

            $this->conn = null;
            session_start();

            // Se inicializa los atributos asociados a la petición en base a la sesión y se eliminan para que no estén disponibles después de la gestión de esta petición.
            $this->atributosPeticion = $_SESSION[self::ATRIBUTOS_PETICION] ?? [];
            unset($_SESSION[self::ATRIBUTOS_PETICION]);

            $this->inicializada = true;
        }
    }

    /** Cierre de la aplicación. */
    public function shutdown() {
        $this->compruebaInstanciaInicializada();
        if ($this->conn !== null && !$this->conn->connect_errno) {
            $this->conn->close();
        }
    }

    /**
     * Metodo que devuelve la ruta hasta un archivo
     * @var string $path ruta
     * @return string
     */
    public function resuelve($path = '') {
        $this->compruebaInstanciaInicializada();
        $rutaAppLongitudPrefijo = mb_strlen($this->rutaRaizApp);
        if (mb_substr($path, 0, $rutaAppLongitudPrefijo) === $this->rutaRaizApp) {
            return $path;
        }
        if (mb_strlen($path) > 0 && mb_substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }
        return $this->rutaRaizApp . $path;
    }

    /**
     * Metodo que incluye un archivo de vista a partir de su URL
     * @var string  $path ruta de la vista que queremos usar
     * @var array   $params parametros que queremos paraserle a la vista
     */
    public function doInclude($path = '') {
        $this->compruebaInstanciaInicializada();
        $params = array();
        $this->doIncludeInterna($path, $params);
    }

    /**
     * Metodo que genera una vista a partir de su URL
     * @var string  $rutaVista ruta de la vista que queremos usar
     * @var array   $params parametros que queremos paraserle a la vista
     */
    public function generaVista(string $rutaVista, &$params) {
        $this->compruebaInstanciaInicializada();
        $params['app'] = $this;
        if (mb_strlen($rutaVista) > 0 && mb_substr($rutaVista, 0, 1) !== '/') {
            $rutaVista = '/' . $rutaVista;
        }
        $rutaVista = "/vistas{$rutaVista}";
        $this->doIncludeInterna($rutaVista, $params);
    }

    public function login(Personas $user) {
        $this->compruebaInstanciaInicializada();
        $_SESSION['login'] = true;
        $_SESSION['id'] = $user->getId();
        $_SESSION['alias'] = $user->getAlias();
        $_SESSION['nombre'] = $user->getNombre();
        $_SESSION['idUsuario'] = $user->getId();
        $_SESSION['rol'] = $user->getRol();
    }

    /** Metodo que cierra sesion borrando las variables de sesion y reiniciando la sesion */
    public function logout() {
        $this->compruebaInstanciaInicializada();
        //Doble seguridad: unset + destroy
        unset($_SESSION['login']);
        unset($_SESSION['nutri']);
        unset($_SESSION['nombre']);
        unset($_SESSION['id']);
        unset($_SESSION['premium']);
        unset($_SESSION['alias']);
        unset($_SESSION['rol']);
        // Reinicia la sesion
        session_destroy();
        session_start();
    }

    /**
     * Metodo que comprueba si el usuario esta logeado
     * @return true|false
     */
    public function usuarioLogueado() {
        $this->compruebaInstanciaInicializada();
        return ($_SESSION['login'] ?? false) === true;
    }

    /**
     * Metodo que devuelve el nick del usuario logeado
     * @return int|string
     */
    public function nombreUsuario() {
        $this->compruebaInstanciaInicializada();
        return $_SESSION['alias'] ?? '';
    }

    /**
     * Metodo que devuelve el ID del usuario logeado
     * @return int|string
     */
    public function idUsuario() {
        $this->compruebaInstanciaInicializada();
        return $_SESSION['id'] ?? '';
    }

    /** Metodo que pone el usuario a premium */
    public function setPremium($pre) {
        $this->compruebaInstanciaInicializada();
        $_SESSION['premium'] = $pre;
    }

    /**
     * Metodo que comprueba si el usuario logeado es admin
     * @return true|false
     */
    public function esAdmin() {
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && $_SESSION['rol'] == Personas::ADMIN_ROLE;
    }
    
    /**
     * Metodo que devuelve si el usuario es premium
     * @return true|false
     */
    public function esPremium() {
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && isset($_SESSION['premium']) && $_SESSION['premium'] == 1;
    }

    /**
     * Metodo que comprueba si el usuario es profesional
     * @return true|false
     */
    public function esProfesional() {
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && $_SESSION['rol'] == Personas::PROFESSIONAL_ROLE;
    }

    /**
     * Metodo que comprueba si el usuario es un usuario estandar
     * @return true|false
     */
    public function esUsuario() {
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && $_SESSION['rol'] == Personas::USER_ROLE;
    }

    /**
     * Metodo que comprueba si el rol existe
     * @var int $rol entero del rol que queremos comprobar
     * @return true|false
     */
    public function tieneRol() {
        $this->compruebaInstanciaInicializada();
        return $this->usuarioLogueado() && isset($_SESSION['rol']);
    }

    /**
     * Metodo que muestra la pagina de error en el caso de que haya ocurrido un problema
     * @var int     $codigoRespuesta codigo de error de HTTP
     * @var string  $tituloPagina titulo de la pagina de error
     * @var string  $mesnajeError cabecera de la pagina de error
     * @var string  $explicacion explicacion del por que ha sucedido
     */
    public function paginaError($codigoRespuesta, $tituloPagina, $mensajeError, $explicacion = '') {
        $this->generandoPaginaError = true;
        http_response_code($codigoRespuesta);

        $params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => "<h1>{$mensajeError}</h1><p>{$explicacion}</p>"];
        $this->generaVista('/plantillas/plantilla.php', $params);
        exit();
    }

    /**
     * Metodo que verifica si el usuario esta logeado y lo redirige a una URL si no lo esta
     */
    public function verificaLogado($urlNoLogado) {
        $this->compruebaInstanciaInicializada();
        if (!$this->usuarioLogueado()) {
            self::redirige($urlNoLogado);
        }
    }

    /**
     * Añade un atributo <code>$valor</code> para que esté disponible en la siguiente petición bajo la clave <code>$clave</code>.
     * @param string $clave Clave bajo la que almacenar el atributo.
     * @param any    $valor Valor a almacenar como atributo de la petición.
     */
    public function putAtributoPeticion($clave, $valor) {
        $atts = null;
        if (isset($_SESSION[self::ATRIBUTOS_PETICION])) {
            $atts = &$_SESSION[self::ATRIBUTOS_PETICION];
        } else {
            $atts = array();
            $_SESSION[self::ATRIBUTOS_PETICION] = &$atts;
        }
        $atts[$clave] = $valor;
    }

    /**
     * Metodo que construye la URL a partir de la ruta relativa y los parametros $_GET[]
     * @var string  $relativeURL path relativo de la localizacion
     * @var array   $params array con los parametros $_GET[] para componer la URL
     */
    public function buildUrl($relativeURL, $params = []) {
        $url = $this->resuelve($relativeURL);
        $query = self::buildParams($params);
        if (!empty($query)) {
            $url .= '?' . $query;
        }
        return $url;
    }

    /**
     * Metodo que redirige a una URL
     * @var string $url URL a donde nos queremos dirigir
     */
    public static function redirige($url) {
        header('Location: ' . $url);
        exit();
    }

    // ==================== PRIVATE ====================
    /** Comprueba si la aplicación está inicializada. Si no lo está muestra un mensaje y termina la ejecución. */
    private function compruebaInstanciaInicializada() {
        if (!$this->inicializada && $this->generandoError) {
            $this->paginaError(502, 'Error', 'Oops', 'La aplicación no está configurada. Tienes que modificar el fichero config.php');
        }
    }

    /**
     * Metodo que incluye un archivo de vista a partir de su URL
     * @var string  $path ruta de la vista que queremos usar
     * @var array   $params parametros que queremos paraserle a la vista
     */
    private function doIncludeInterna($path, &$params) {
        $this->compruebaInstanciaInicializada();
        if (mb_strlen($path) > 0 && mb_substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }
        include($this->dirInstalacion . $path);
    }

    // ==================== METODOS ====================
    // ==================== estaticos ====================
    /**
     * Metodo que construye una url a partir de los parametros que se le pasan
     * @var array   $params array con los parametros $_GET[] para componer la URL
     * @var string  $separator separador de parametros de la URL
     * @var string  $enclosing encapsulador para parametos
     * @return string URL compuesta 
     */
    public static function buildParams($params, $separator = '&', $enclosing = '') {
        $query = '';
        $numParams = 0;
        foreach ($params as $param => $value) {
            if ($value != null) {
                if ($numParams > 0) {
                    $query .= $separator;
                }
                $query .= "{$param}={$enclosing}{$value}{$enclosing}";
                $numParams++;
            }
        }
        return $query;
    }

    /**
     * Devuele una instancia de {@see Aplicacion}.
     * @return Applicacion Obtiene la única instancia de la <code>Aplicacion</code>
     */
    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new static();
        }
        return self::$instancia;
    }
}