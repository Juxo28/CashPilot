<?php

// TEMPORAL: mientras no exista el login, la aplicación "finge" que siempre trabaja
// con la empresa 1 y el usuario 1. Cuando hagamos el login, estos valores saldrán de $_SESSION.
define('ID_EMPRESA_ACTUAL', 1);
define('ID_USUARIO_ACTUAL', 1);

// En desarrollo (true) se muestran los mensajes técnicos de error.
// En producción debe ser false.
define('APP_DEBUG', true);
