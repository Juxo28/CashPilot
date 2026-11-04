/**
 * Páginas protegidas (todas las rutas que pasan por public/index.php, menos /login).
 * PHP ya validó el token antes de mostrar la página; este archivo controla la parte visual:
 * muestra el usuario, mantiene el token actualizado y gestiona el cierre de sesión.
 */
(function () {
  const $ = (sel) => document.querySelector(sel);
  const LOGOUT = "/logout";

  function mostrarUsuario(user) {
    document.querySelectorAll("[data-user-email]").forEach((el) => {
      el.textContent = user.email || "—";
    });
  }

  async function cerrarSesion() {
    const btn = $("#btn-logout");
    if (btn) btn.disabled = true;
    try {
      await window.supabaseClient?.auth.signOut();
    } catch (_) {
      // Aunque falle la red, se cierra la sesión en el servidor.
    }
    window.authGuardarToken?.(null);
    location.href = LOGOUT;
  }

  async function init() {
    $("#btn-logout")?.addEventListener("click", cerrarSesion);

    if (window.__AUTH_CONFIG_MISSING__ || !window.supabaseClient) {
      location.href = LOGOUT;
      return;
    }

    const { data, error } = await window.supabaseClient.auth.getSession();
    if (error || !data?.session) {
      location.href = LOGOUT;
      return;
    }

    window.authGuardarToken(data.session);
    mostrarUsuario(data.session.user);
    document.body.classList.add("auth-ready");

    window.supabaseClient.auth.onAuthStateChange((evento) => {
      if (evento === "SIGNED_OUT") {
        location.href = LOGOUT;
      }
    });
  }

  init();
})();
