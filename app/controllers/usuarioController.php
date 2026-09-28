<?php

require_once __DIR__ . "/../models/usuario.php";
require_once __DIR__ . "/../models/persona.php";
require_once __DIR__ . "/../models/rol.php";

class UsuarioController
{
    public function index()
    {
        try {
            $usuarioModel = new Usuario();
            $usuarios = $usuarioModel->getAllByEmpresa(ID_EMPRESA_ACTUAL);

            require __DIR__ . "/../views/usuario/index.php";
        } catch (PDOException $e) {
            mostrarError("los usuarios", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = [];
        $personas = [];
        $roles = [];

        try {
            $personaModel = new PersonaModel();
            $rolModel = new Rol();
            $personas = $personaModel->getSinUsuario();   // llena el <select> de personas
            $roles = $rolModel->getAll();                  // llena el <select> de roles
        } catch (PDOException $e) {
            $errores[] = mensajeBD($e);
        }

        require __DIR__ . "/../views/usuario/crear.php";
    }

    public function guardar()
    {
        $old = [
            'id_persona' => post('id_persona'),
            'id_rol'     => post('id_rol'),
            'usuario'    => post('usuario'),
        ];
        // La contraseña NO va en $old (no se devuelve al formulario) y no se le hace trim.
        $password  = (string) ($_POST['password'] ?? '');
        $password2 = (string) ($_POST['password2'] ?? '');

        $errores = [];
        $personas = [];
        $roles = [];

        try {
            $personaModel = new PersonaModel();
            $rolModel = new Rol();
            $personas = $personaModel->getSinUsuario();
            $roles = $rolModel->getAll();

            // El valor enviado debe ser una de las opciones que realmente ofrecimos en el <select>.
            $idsPersonas = array_map('strval', array_column($personas, 'id_persona'));
            $idsRoles    = array_map('strval', array_column($roles, 'id_rol'));

            if (!in_array($old['id_persona'], $idsPersonas, true)) {
                $errores[] = "Elige una persona de la lista (que aún no tenga usuario).";
            }
            if (!in_array($old['id_rol'], $idsRoles, true)) {
                $errores[] = "Elige un rol de la lista.";
            }
            if (preg_match('/^[A-Za-z0-9_.\-]{3,40}$/', $old['usuario']) !== 1) {
                $errores[] = "El usuario debe tener entre 3 y 40 caracteres: letras, números, punto, guion o guion bajo.";
            }
            if (strlen($password) < 8) {
                $errores[] = "La contraseña debe tener al menos 8 caracteres.";
            } elseif ($password !== $password2) {
                $errores[] = "Las dos contraseñas no coinciden.";
            }

            if (empty($errores)) {
                $usuarioModel = new Usuario();
                $usuarioModel->create(ID_EMPRESA_ACTUAL, $old + ['password' => $password]);
                redirigir('/usuario?guardado=1');
            }
        } catch (PDOException $e) {
            $errores[] = mensajeBD($e);
        }

        require __DIR__ . "/../views/usuario/crear.php";
    }
}
