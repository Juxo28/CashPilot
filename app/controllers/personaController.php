<?php

require_once __DIR__ . "/../models/persona.php";

class PersonaController
{
    public function index()
    {
        try {
            $personaModel = new PersonaModel();
            $personas = $personaModel->getAll();

            require __DIR__ . "/../views/persona/index.php";
        } catch (PDOException $e) {
            mostrarError("las personas", $e);
        }
    }

    public function crear()
    {
        $errores = [];
        $old = [];
        require __DIR__ . "/../views/persona/crear.php";
    }

    public function guardar()
    {
        $old = [
            'nombre'   => post('nombre'),
            'apellido' => post('apellido'),
            'telefono' => post('telefono'),
            'correo'   => post('correo'),
        ];
        $errores = [];

        // Estas condiciones son las mismas ideas de los setters de tu clase Persona
        // (is_string + trim !== ""), ahora aplicadas a lo que llega del formulario.
        if ($old['nombre'] === '' || mb_strlen($old['nombre']) > 60) {
            $errores[] = "El nombre es obligatorio (máximo 60 caracteres).";
        }
        if ($old['apellido'] === '' || mb_strlen($old['apellido']) > 60) {
            $errores[] = "El apellido es obligatorio (máximo 60 caracteres).";
        }
        if (mb_strlen($old['telefono']) > 20 || preg_match('/^[0-9+\-\s]*$/', $old['telefono']) !== 1) {
            $errores[] = "El teléfono solo puede tener números, espacios, + y - (máximo 20 caracteres).";
        }
        if ($old['correo'] !== '' && (mb_strlen($old['correo']) > 120 || !filter_var($old['correo'], FILTER_VALIDATE_EMAIL))) {
            $errores[] = "El correo no tiene un formato válido.";
        }

        if (empty($errores)) {
            try {
                $personaModel = new PersonaModel();
                $personaModel->create($old);
                redirigir('/persona?guardado=1');
            } catch (PDOException $e) {
                $errores[] = mensajeBD($e);
            }
        }

        require __DIR__ . "/../views/persona/crear.php";
    }
}
