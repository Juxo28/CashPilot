/**
 * Configuración pública de Supabase (navegador).
 *
 * 1. Copia este archivo como: public/assets/js/auth/config.js
 * 2. Pega la Project URL y la publishable key desde:
 *    Supabase → Project Settings → API Keys
 * 3. NUNCA pegues aquí la service_role ni la secret key.
 *
 * Los mismos dos valores van en el archivo .env (lo usa PHP para validar el token).
 */
window.APP_CONFIG = {
  SUPABASE_URL: "https://TU-PROYECTO.supabase.co",
  SUPABASE_PUBLISHABLE_KEY: "pega_aqui_tu_publishable_key",
};
