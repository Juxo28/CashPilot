/**
 * Cliente único de Supabase para toda la app.
 * Requiere: public/assets/js/auth/config.js + librería @supabase/supabase-js (CDN).
 *
 * Además copia el access token a la cookie "sb_access_token" para que PHP
 * (config/auth.php) pueda validarlo en cada petición al servidor.
 */
(function () {
  const COOKIE = "sb_access_token";
  const cfg = window.APP_CONFIG || {};
  const url = (cfg.SUPABASE_URL || "").trim();
  const key = (cfg.SUPABASE_PUBLISHABLE_KEY || cfg.SUPABASE_ANON_KEY || "").trim();

  const faltaConfig =
    !url || !key || url.includes("TU-PROYECTO") || key.includes("pega_aqui");

  if (faltaConfig) {
    console.warn("[Auth] Falta configurar public/assets/js/auth/config.js (SUPABASE_URL y SUPABASE_PUBLISHABLE_KEY).");
    window.__AUTH_CONFIG_MISSING__ = true;
  }

  /** Guarda (o borra) el token en la cookie que lee PHP. */
  function guardarToken(session) {
    const seguro = location.protocol === "https:" ? "; Secure" : "";
    if (session && session.access_token) {
      const segundos = Math.max(0, (session.expires_at || 0) - Math.floor(Date.now() / 1000));
      document.cookie =
        COOKIE + "=" + session.access_token + "; Path=/; Max-Age=" + segundos + "; SameSite=Lax" + seguro;
    } else {
      document.cookie = COOKIE + "=; Path=/; Max-Age=0; SameSite=Lax" + seguro;
    }
  }
  window.authGuardarToken = guardarToken;

  if (typeof window.supabase === "undefined" || !window.supabase.createClient) {
    console.error("[Auth] No se cargó la librería @supabase/supabase-js (CDN).");
    window.supabaseClient = null;
    return;
  }

  window.supabaseClient = window.supabase.createClient(
    url || "https://invalid.local",
    key || "invalid",
    { auth: { persistSession: true, autoRefreshToken: true } }
  );

  // Cada vez que Supabase inicia, renueva o cierra la sesión, se actualiza la cookie.
  window.supabaseClient.auth.onAuthStateChange((_evento, session) => {
    guardarToken(session);
  });
})();
