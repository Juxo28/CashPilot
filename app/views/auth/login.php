<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashPilot | Iniciar sesión</title>
    <link rel="stylesheet" href="/estilos.css">
</head>
<body class="login">
    <main class="login-caja">
        <h1>CashPilot</h1>
        <p class="login-ayuda">Inicia sesión con tu correo y contraseña.</p>

        <p id="config-banner" class="aviso aviso--error" hidden>
            Falta configurar <strong>public/assets/js/auth/config.js</strong> con la URL y la publishable key de Supabase.
        </p>

        <?php if ($salio): ?>
            <p class="aviso aviso--ok" data-aviso-servidor>Sesión cerrada correctamente.</p>
        <?php elseif ($avisoSesion !== ''): ?>
            <p class="aviso aviso--error" data-aviso-servidor><?= htmlspecialchars($avisoSesion, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <p id="auth-message" class="aviso" role="alert" hidden></p>

        <form id="form-login" class="login-form" novalidate>
            <label for="login-email">Correo</label>
            <input id="login-email" type="email" autocomplete="email" required>

            <label for="login-password">Contraseña</label>
            <input id="login-password" type="password" autocomplete="current-password" required minlength="6">

            <button type="submit">Entrar</button>
        </form>
    </main>

    <script src="/assets/js/auth/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2.45.4/dist/umd/supabase.js"></script>
    <script src="/assets/js/auth/supabase-client.js"></script>
    <script src="/assets/js/auth/auth.js"></script>
</body>
</html>
