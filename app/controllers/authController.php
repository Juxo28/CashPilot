<?php

require_once __DIR__ . "/../../config/auth.php";

class authController
{
    /** GET /login: muestra el formulario. Si el servidor ya reconoce la sesión, pasa al inicio. */
    public function login()
    {
        if (!isset($_GET['salio'])) {
            try {
                if (auth_usuario() !== null) {
                    header('Location: /');
                    exit;
                }
            } catch (Throwable $e) {
                // Sin conexión con Supabase: se muestra el login normalmente.
            }
        }

        $avisoSesion = (string) ($_GET['sesion'] ?? '');
        $salio = isset($_GET['salio']);
        require_once __DIR__ . "/../views/auth/login.php";
    }

    /** GET /logout: cierra la sesión en el servidor y vuelve al login. */
    public function logout()
    {
        auth_cerrar();
        header('Location: /login?salio=1');
        exit;
    }
}
