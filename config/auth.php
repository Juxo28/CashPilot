<?php

/**
 * Validación de la sesión de Supabase del lado del servidor.
 *
 * El navegador guarda el access token de Supabase en la cookie "sb_access_token"
 * (public/assets/js/auth/supabase-client.js). Antes de ejecutar cualquier controlador,
 * public/index.php llama a auth_requerir(): PHP le pregunta a Supabase
 * (GET /auth/v1/user) si el token es válido. Si no lo es, la petición se rechaza,
 * aunque la URL se escriba a mano.
 */

const AUTH_COOKIE = 'sb_access_token';
// Segundos que se reutiliza una validación correcta antes de volver a consultar a Supabase.
const AUTH_CACHE_SEGUNDOS = 60;

/** URL y publishable key de Supabase, leídas del archivo .env (igual que config/database.php). */
function auth_config()
{
    $env = @parse_ini_file(__DIR__ . "/../.env") ?: [];
    $url = rtrim((string) ($env['SUPABASE_URL'] ?? ''), '/');
    $clave = (string) ($env['SUPABASE_PUBLISHABLE_KEY'] ?? '');

    if ($url === '' || $clave === '' || str_contains($url, 'TU-PROYECTO') || str_contains($clave, 'pega_aqui')) {
        throw new RuntimeException('Falta configurar SUPABASE_URL y SUPABASE_PUBLISHABLE_KEY en el archivo .env.');
    }
    return ['url' => $url, 'clave' => $clave];
}

/** Token enviado por el navegador: encabezado "Authorization: Bearer ..." o la cookie. */
function auth_token()
{
    $encabezado = (string) ($_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '');
    if (preg_match('/^Bearer\s+(\S+)$/i', $encabezado, $coincide) === 1) {
        return $coincide[1];
    }
    return (string) ($_COOKIE[AUTH_COOKIE] ?? '');
}

/** Fecha de vencimiento (exp) del JWT. Solo se lee; la validez real la confirma Supabase. */
function auth_token_vence($token)
{
    $partes = explode('.', $token);
    if (count($partes) !== 3) {
        return 0;
    }
    $json = base64_decode(strtr($partes[1], '-_', '+/'), true);
    $datos = $json === false ? null : json_decode($json, true);
    return is_array($datos) ? (int) ($datos['exp'] ?? 0) : 0;
}

function auth_sesion_php()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
        session_start();
    }
}

/** Certificado CA para cURL (en XAMPP para Windows no viene configurado). */
function auth_ca_bundle()
{
    $opciones = [
        (string) ini_get('curl.cainfo'),
        (string) ini_get('openssl.cafile'),
        'C:/xampp/apache/bin/curl-ca-bundle.crt',
        'C:/xampp/php/extras/ssl/cacert.pem',
    ];
    foreach ($opciones as $ruta) {
        if ($ruta !== '' && is_file($ruta)) {
            return $ruta;
        }
    }
    return null;
}

/** Pregunta a Supabase a quién pertenece el token. Devuelve null si no es válido. */
function auth_consultar_supabase($token)
{
    $config = auth_config();
    $curl = curl_init($config['url'] . '/auth/v1/user');
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_HTTPHEADER => [
            'apikey: ' . $config['clave'],
            'Authorization: Bearer ' . $token,
        ],
    ]);
    $ca = auth_ca_bundle();
    if ($ca !== null) {
        curl_setopt($curl, CURLOPT_CAINFO, $ca);
    }

    $respuesta = curl_exec($curl);
    $codigo = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $errorCurl = curl_error($curl);
    curl_close($curl);

    if ($respuesta === false) {
        throw new RuntimeException('No se pudo validar la sesión con Supabase: ' . $errorCurl);
    }
    if ($codigo !== 200) {
        return null;
    }
    $usuario = json_decode((string) $respuesta, true);
    if (!is_array($usuario) || empty($usuario['id'])) {
        return null;
    }
    return [
        'id' => (string) $usuario['id'],
        'email' => (string) ($usuario['email'] ?? ''),
    ];
}

/** Usuario autenticado de esta petición, o null si no hay un token válido. */
function auth_usuario()
{
    $token = auth_token();
    if ($token === '' || substr_count($token, '.') !== 2) {
        return null;
    }
    $vence = auth_token_vence($token);
    if ($vence <= time()) {
        return null;
    }

    auth_sesion_php();
    $huella = hash('sha256', $token);
    $cache = $_SESSION['auth'] ?? null;
    if (is_array($cache) && ($cache['huella'] ?? '') === $huella && ($cache['hasta'] ?? 0) > time()) {
        return $cache['usuario'];
    }

    $usuario = auth_consultar_supabase($token);
    if ($usuario === null) {
        unset($_SESSION['auth']);
        return null;
    }
    $_SESSION['auth'] = [
        'huella' => $huella,
        'hasta' => min(time() + AUTH_CACHE_SEGUNDOS, $vence),
        'usuario' => $usuario,
    ];
    return $usuario;
}

/**
 * Detiene la petición si no hay sesión válida.
 * Navegación normal: redirige a /login. Peticiones fetch/JSON: responde 401.
 */
function auth_requerir()
{
    try {
        $usuario = auth_usuario();
        $motivo = 'Inicia sesión para continuar.';
    } catch (Throwable $e) {
        $usuario = null;
        $motivo = $e->getMessage();
    }

    if ($usuario !== null) {
        return $usuario;
    }

    $aceptaJson = str_contains((string) ($_SERVER['HTTP_ACCEPT'] ?? ''), 'application/json');
    if ($aceptaJson) {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => false, 'error' => $motivo], JSON_UNESCAPED_UNICODE);
        exit;
    }
    header('Location: /login?sesion=' . rawurlencode($motivo));
    exit;
}

/** Cierra la sesión del lado del servidor. */
function auth_cerrar()
{
    auth_sesion_php();
    $_SESSION = [];
    session_destroy();
    setcookie(AUTH_COOKIE, '', ['expires' => time() - 3600, 'path' => '/', 'samesite' => 'Lax']);
}
