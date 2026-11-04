/**
 * Lógica del formulario de inicio de sesión (app/views/auth/login.php).
 * Valida los campos, inicia sesión con Supabase y redirige al inicio de CashPilot.
 */
(function () {
  const $ = (sel) => document.querySelector(sel);

  const INICIO = "/";
  const formLogin = $("#form-login");
  const inputEmail = $("#login-email");
  const inputPassword = $("#login-password");
  const msgEl = $("#auth-message");
  const configBanner = $("#config-banner");
  const parametros = new URLSearchParams(location.search);

  function mostrarMensaje(texto, tipo = "error") {
    if (!msgEl) return;
    msgEl.textContent = texto;
    msgEl.className = "aviso aviso--" + tipo;
    msgEl.hidden = !texto;
    if (texto) {
      document.querySelectorAll("[data-aviso-servidor]").forEach((el) => (el.hidden = true));
    }
  }

  function cargando(activo) {
    const btn = formLogin?.querySelector('button[type="submit"]');
    if (!btn) return;
    btn.disabled = activo;
    btn.textContent = activo ? "Ingresando…" : "Entrar";
  }

  function traducirError(error) {
    const texto = (error && error.message) || "";
    if (/invalid login credentials/i.test(texto)) return "Correo o contraseña incorrectos.";
    if (/email not confirmed/i.test(texto)) return "Debes confirmar tu correo antes de ingresar.";
    if (/failed to fetch|network/i.test(texto)) return "No se pudo conectar con Supabase. Revisa tu conexión.";
    return texto || "No se pudo iniciar sesión.";
  }

  function validar(email, password) {
    if (!email) return "Escribe tu correo.";
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return "Escribe un correo válido.";
    if (!password) return "Escribe tu contraseña.";
    if (password.length < 6) return "La contraseña debe tener al menos 6 caracteres.";
    return "";
  }

  function cliente() {
    if (window.__AUTH_CONFIG_MISSING__) {
      mostrarMensaje("Configura public/assets/js/auth/config.js con tu SUPABASE_URL y SUPABASE_PUBLISHABLE_KEY.");
      return null;
    }
    if (!window.supabaseClient) {
      mostrarMensaje("No se pudo inicializar Supabase. Revisa la consola del navegador.");
      return null;
    }
    return window.supabaseClient;
  }

  /** Si ya hay sesión en el navegador, entra directo (mantener sesión al recargar). */
  async function entrarSiHaySesion() {
    const client = window.supabaseClient;
    if (!client || window.__AUTH_CONFIG_MISSING__) return;

    // Viene de cerrar sesión: limpiar también la sesión del navegador.
    if (parametros.has("salio")) {
      await client.auth.signOut({ scope: "local" });
      window.authGuardarToken(null);
      return;
    }

    const { data } = await client.auth.getSession();
    if (!data?.session) return;

    // Evita un ciclo login ↔ index si el servidor rechaza el token.
    let ultimo = 0;
    try { ultimo = Number(sessionStorage.getItem("auth_redireccion") || 0); } catch (_) {}
    if (Date.now() - ultimo < 10000) return;
    try { sessionStorage.setItem("auth_redireccion", String(Date.now())); } catch (_) {}

    window.authGuardarToken(data.session);
    location.href = INICIO;
  }

  formLogin?.addEventListener("submit", async (evento) => {
    evento.preventDefault();
    const client = cliente();
    if (!client) return;

    const email = inputEmail.value.trim();
    const password = inputPassword.value;
    const problema = validar(email, password);
    if (problema) {
      mostrarMensaje(problema);
      return;
    }

    cargando(true);
    mostrarMensaje("");
    const { data, error } = await client.auth.signInWithPassword({ email, password });
    cargando(false);

    if (error) {
      mostrarMensaje(traducirError(error));
      inputPassword.value = "";
      inputPassword.focus();
      return;
    }

    window.authGuardarToken(data.session);
    try { sessionStorage.setItem("auth_redireccion", String(Date.now())); } catch (_) {}
    mostrarMensaje("Sesión iniciada. Redirigiendo…", "ok");
    location.href = INICIO;
  });

  if (configBanner && window.__AUTH_CONFIG_MISSING__) {
    configBanner.hidden = false;
  }

  entrarSiHaySesion();
})();
