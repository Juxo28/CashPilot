-- =====================================================================
--  CashPilot - Base de datos (versión corregida)
--  Motor: MySQL 8 / MariaDB 10.4+  |  Charset: utf8mb4  |  Motor: InnoDB
--
--  Este script es NO destructivo: crea una base NUEVA llamada `cashpilot`
--  y no toca tu base anterior `cashpilott`.
--  Para reiniciar desde cero durante el aprendizaje, ejecuta antes:
--      DROP DATABASE cashpilot;
--
--  SECCIONES
--    1. Estructura  (tablas, claves primarias, foráneas, restricciones)
--    2. Datos de tu export original (sin los departamentos duplicados)
--    3. Datos de PRUEBA propuestos (rol, persona, usuario) - reemplázalos
-- =====================================================================

-- Le indica al servidor que este archivo está en UTF-8 (evita que 'Tecnología' se guarde como 'TecnologÃ­a').
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS cashpilot
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE cashpilot;

-- =====================================================================
-- 1. ESTRUCTURA
--    Orden: primero las tablas "padre" (a las que otras apuntan),
--    después las "hijas" (que llevan la clave foránea).
-- =====================================================================

-- ---- Sin dependencias ------------------------------------------------

CREATE TABLE empresa (
    id_empresa      INT          NOT NULL AUTO_INCREMENT,
    nombre_empresa  VARCHAR(120) NOT NULL,
    nit             VARCHAR(20)  NOT NULL,
    direccion       VARCHAR(200) NULL,
    telefono        VARCHAR(20)  NULL,
    correo          VARCHAR(120) NULL,
    fecha_registro  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_empresa),
    UNIQUE KEY uq_empresa_nit (nit)
) ENGINE=InnoDB;

CREATE TABLE rol (
    id_rol      INT          NOT NULL AUTO_INCREMENT,
    nombre_rol  VARCHAR(40)  NOT NULL,
    descripcion VARCHAR(255) NULL,
    PRIMARY KEY (id_rol),
    UNIQUE KEY uq_rol_nombre (nombre_rol)
) ENGINE=InnoDB;

CREATE TABLE persona (
    id_persona INT          NOT NULL AUTO_INCREMENT,
    nombre     VARCHAR(60)  NOT NULL,
    apellido   VARCHAR(60)  NOT NULL,
    telefono   VARCHAR(20)  NULL,
    correo     VARCHAR(120) NULL,
    PRIMARY KEY (id_persona),
    UNIQUE KEY uq_persona_correo (correo)
) ENGINE=InnoDB;

-- ---- Dependen de empresa / rol / persona ------------------------------

CREATE TABLE usuario (
    id_usuario     INT          NOT NULL AUTO_INCREMENT,
    id_empresa     INT          NOT NULL,
    id_persona     INT          NOT NULL,
    id_rol         INT          NOT NULL,
    usuario        VARCHAR(40)  NOT NULL,
    password       VARCHAR(255) NOT NULL,          -- SIEMPRE un hash de password_hash(), nunca texto plano
    estado         TINYINT(1)   NOT NULL DEFAULT 1, -- 1 = activo, 0 = inactivo
    fecha_registro DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario),
    UNIQUE KEY uq_usuario_login   (usuario),
    UNIQUE KEY uq_usuario_persona (id_persona),
    UNIQUE KEY uq_usuario_empresa (id_usuario, id_empresa),   -- lo usan las FK compuestas de abajo
    CONSTRAINT fk_usuario_empresa FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa),
    CONSTRAINT fk_usuario_persona FOREIGN KEY (id_persona) REFERENCES persona (id_persona),
    CONSTRAINT fk_usuario_rol     FOREIGN KEY (id_rol)     REFERENCES rol (id_rol)
) ENGINE=InnoDB;

CREATE TABLE categoria (
    id_categoria     INT          NOT NULL AUTO_INCREMENT,
    id_empresa       INT          NOT NULL,
    nombre_categoria VARCHAR(60)  NOT NULL,
    tipo_categoria   ENUM('ingreso','gasto') NOT NULL,
    descripcion      VARCHAR(255) NULL,
    PRIMARY KEY (id_categoria),
    UNIQUE KEY uq_categoria_nombre  (id_empresa, tipo_categoria, nombre_categoria),
    UNIQUE KEY uq_categoria_empresa (id_categoria, id_empresa),
    CONSTRAINT fk_categoria_empresa FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa)
) ENGINE=InnoDB;

CREATE TABLE departamento (
    id_departamento     INT           NOT NULL AUTO_INCREMENT,
    id_empresa          INT           NOT NULL,
    nombre_departamento VARCHAR(80)   NOT NULL,
    descripcion         VARCHAR(255)  NULL,
    presupuesto         DECIMAL(15,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (id_departamento),
    UNIQUE KEY uq_departamento_nombre  (id_empresa, nombre_departamento),  -- evita duplicados
    UNIQUE KEY uq_departamento_empresa (id_departamento, id_empresa),
    CONSTRAINT fk_departamento_empresa FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa),
    CONSTRAINT chk_departamento_presupuesto CHECK (presupuesto >= 0)
) ENGINE=InnoDB;

-- ---- Movimientos financieros ------------------------------------------
-- Las claves foráneas COMPUESTAS (id_x, id_empresa) garantizan que un gasto
-- o ingreso solo pueda usar categorías, departamentos y usuarios de SU MISMA empresa.

CREATE TABLE gasto (
    id_gasto        INT           NOT NULL AUTO_INCREMENT,
    id_empresa      INT           NOT NULL,
    id_departamento INT           NOT NULL,
    id_categoria    INT           NOT NULL,
    id_usuario      INT           NOT NULL,
    monto           DECIMAL(15,2) NOT NULL,
    fecha           DATE          NOT NULL,
    descripcion     VARCHAR(255)  NOT NULL,
    metodo_pago     ENUM('Efectivo','Tarjeta','Transferencia') NOT NULL,
    comprobante     VARCHAR(150)  NULL,
    fecha_registro  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_gasto),
    KEY idx_gasto_empresa_fecha (id_empresa, fecha),
    CONSTRAINT fk_gasto_empresa      FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa),
    CONSTRAINT fk_gasto_departamento FOREIGN KEY (id_departamento, id_empresa) REFERENCES departamento (id_departamento, id_empresa),
    CONSTRAINT fk_gasto_categoria    FOREIGN KEY (id_categoria, id_empresa)    REFERENCES categoria (id_categoria, id_empresa),
    CONSTRAINT fk_gasto_usuario      FOREIGN KEY (id_usuario, id_empresa)      REFERENCES usuario (id_usuario, id_empresa),
    CONSTRAINT chk_gasto_monto CHECK (monto > 0)
) ENGINE=InnoDB;

CREATE TABLE ingreso (
    id_ingreso     INT           NOT NULL AUTO_INCREMENT,
    id_empresa     INT           NOT NULL,
    id_categoria   INT           NOT NULL,
    id_usuario     INT           NOT NULL,
    monto          DECIMAL(15,2) NOT NULL,
    fecha          DATE          NOT NULL,
    descripcion    VARCHAR(255)  NOT NULL,
    fuente         VARCHAR(120)  NULL,
    fecha_registro DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_ingreso),
    KEY idx_ingreso_empresa_fecha (id_empresa, fecha),
    CONSTRAINT fk_ingreso_empresa   FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa),
    CONSTRAINT fk_ingreso_categoria FOREIGN KEY (id_categoria, id_empresa) REFERENCES categoria (id_categoria, id_empresa),
    CONSTRAINT fk_ingreso_usuario   FOREIGN KEY (id_usuario, id_empresa)   REFERENCES usuario (id_usuario, id_empresa),
    CONSTRAINT chk_ingreso_monto CHECK (monto > 0)
) ENGINE=InnoDB;

-- ---- Análisis y reportes ------------------------------------------------

CREATE TABLE analisis_financiero (
    id_analisis       INT         NOT NULL AUTO_INCREMENT,
    id_empresa        INT         NOT NULL,
    id_usuario_genera INT         NOT NULL,
    fecha_analisis    DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    tipo_analisis     VARCHAR(40) NOT NULL,
    resultado         JSON        NOT NULL,
    PRIMARY KEY (id_analisis),
    CONSTRAINT fk_analisis_empresa FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa),
    CONSTRAINT fk_analisis_usuario FOREIGN KEY (id_usuario_genera, id_empresa) REFERENCES usuario (id_usuario, id_empresa)
) ENGINE=InnoDB;

CREATE TABLE reporte (
    id_reporte        INT          NOT NULL AUTO_INCREMENT,
    id_empresa        INT          NOT NULL,
    id_usuario_genera INT          NOT NULL,
    fecha_generacion  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    tipo_reporte      VARCHAR(40)  NOT NULL,
    parametros        JSON         NULL,
    archivo           VARCHAR(150) NULL,
    PRIMARY KEY (id_reporte),
    CONSTRAINT fk_reporte_empresa FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa),
    CONSTRAINT fk_reporte_usuario FOREIGN KEY (id_usuario_genera, id_empresa) REFERENCES usuario (id_usuario, id_empresa)
) ENGINE=InnoDB;

-- =====================================================================
-- 2. DATOS DE TU EXPORT ORIGINAL
--    (empresa, categoria, departamento, gasto, ingreso, analisis, reporte)
--    Cambios: se eliminaron los departamentos 8 a 14, que repetían a los 1 a 7.
-- =====================================================================

INSERT INTO empresa (id_empresa, nombre_empresa, nit, direccion, telefono, correo, fecha_registro) VALUES
(1, 'Tecnología Avanzada SAS',          '900123456-7', 'Calle 50 #45-20, Medellín',   '6045123456', 'contacto@tecnologiaavanzada.com',   '2026-03-25 13:01:11'),
(2, 'Distribuidora de Alimentos Ltda',  '800987654-3', 'Carrera 30 #20-15, Bogotá',   '6019876543', 'info@distribuidoraalimentos.com',   '2026-03-25 13:01:11'),
(3, 'Constructora Moderna SA',          '901234567-8', 'Avenida 4 #10-60, Cali',      '6023456789', 'constructora@moderna.com',          '2026-03-25 13:01:11');

-- Sección 3 (rol, persona, usuario) va aquí porque gasto/ingreso/análisis/reporte
-- dependen de usuario. Ver bloque de datos de prueba más abajo.

-- =====================================================================
-- 3. DATOS DE PRUEBA PROPUESTOS  (rol, persona, usuario)
--    Tu export original NO incluía estas tablas. Se dedujo por tus datos que existen
--    los usuarios 1 a 6 y a qué empresa pertenece cada uno. Los nombres, roles y
--    contraseña son MARCADORES DE POSICIÓN: reemplázalos por los reales.
--    Contraseña de todos los usuarios de prueba: Prueba123*   (solo para desarrollo local)
-- =====================================================================

INSERT INTO rol (id_rol, nombre_rol, descripcion) VALUES
(1, 'Administrador', 'Gestiona usuarios, roles, departamentos, categorías, información financiera y reportes'),
(2, 'Gerente',       'Supervisa y analiza ingresos, gastos, reportes y departamentos'),
(3, 'Empleado',      'Registra y consulta los movimientos que le correspondan');

INSERT INTO persona (id_persona, nombre, apellido, telefono, correo) VALUES
(1, 'Persona', 'Prueba 1', '3000000001', 'prueba1@example.com'),
(2, 'Persona', 'Prueba 2', '3000000002', 'prueba2@example.com'),
(3, 'Persona', 'Prueba 3', '3000000003', 'prueba3@example.com'),
(4, 'Persona', 'Prueba 4', '3000000004', 'prueba4@example.com'),
(5, 'Persona', 'Prueba 5', '3000000005', 'prueba5@example.com'),
(6, 'Persona', 'Prueba 6', '3000000006', 'prueba6@example.com');

INSERT INTO usuario (id_usuario, id_empresa, id_persona, id_rol, usuario, password, estado) VALUES
(1, 1, 1, 1, 'admin_emp1',    '$2y$10$ZFHBnyphbgm2I6QuGfgTee8MaorBRnSVK.ismREIcnYIlH.Toko8G', 1),
(2, 1, 2, 2, 'gerente_emp1',  '$2y$10$ZFHBnyphbgm2I6QuGfgTee8MaorBRnSVK.ismREIcnYIlH.Toko8G', 1),
(3, 1, 3, 3, 'empleado_emp1', '$2y$10$ZFHBnyphbgm2I6QuGfgTee8MaorBRnSVK.ismREIcnYIlH.Toko8G', 1),
(4, 2, 4, 1, 'admin_emp2',    '$2y$10$ZFHBnyphbgm2I6QuGfgTee8MaorBRnSVK.ismREIcnYIlH.Toko8G', 1),
(5, 2, 5, 3, 'empleado_emp2', '$2y$10$ZFHBnyphbgm2I6QuGfgTee8MaorBRnSVK.ismREIcnYIlH.Toko8G', 1),
(6, 3, 6, 1, 'admin_emp3',    '$2y$10$ZFHBnyphbgm2I6QuGfgTee8MaorBRnSVK.ismREIcnYIlH.Toko8G', 1);

-- ---- Continuación de la sección 2 ---------------------------------------

INSERT INTO categoria (id_categoria, id_empresa, nombre_categoria, tipo_categoria, descripcion) VALUES
(1,  1, 'Ventas de Software', 'ingreso', 'Ingresos por ventas de software'),
(2,  1, 'Consultoría',        'ingreso', 'Servicios de consultoría'),
(3,  1, 'Salarios',           'gasto',   'Nómina'),
(4,  1, 'Papelería',          'gasto',   'Material de oficina'),
(5,  1, 'Licencias',          'gasto',   'Software y licencias'),
(6,  2, 'Ventas',             'ingreso', 'Venta de productos'),
(7,  2, 'Servicios',          'ingreso', 'Servicios adicionales'),
(8,  2, 'Compras',            'gasto',   'Compra de mercancía'),
(9,  2, 'Transporte',         'gasto',   'Fletes y distribución'),
(10, 3, 'Proyectos',          'ingreso', 'Ingresos por proyectos'),
(11, 3, 'Materiales',         'gasto',   'Materiales de construcción'),
(12, 3, 'Maquinaria',         'gasto',   'Alquiler y mantenimiento');

INSERT INTO departamento (id_departamento, id_empresa, nombre_departamento, descripcion, presupuesto) VALUES
(1, 1, 'Ventas',      'Departamento comercial y ventas', 15000000.00),
(2, 1, 'Tecnología',  'Desarrollo y soporte técnico',    25000000.00),
(3, 1, 'Marketing',   'Publicidad y mercadeo',           10000000.00),
(4, 2, 'Ventas',      'Ventas y atención al cliente',    18000000.00),
(5, 2, 'Logística',   'Distribución y bodega',           22000000.00),
(6, 3, 'Obras',       'Construcción en sitio',           35000000.00),
(7, 3, 'Diseño',      'Planos y diseños',                18000000.00);

INSERT INTO gasto (id_gasto, id_empresa, id_departamento, id_categoria, id_usuario, monto, fecha, descripcion, metodo_pago, comprobante) VALUES
(1,  1, 1, 3,  1, 8000000.00,  '2026-01-05', 'Nómina enero',            'Transferencia', 'nomina_ene_ventas.pdf'),
(2,  1, 2, 3,  2, 8200000.00,  '2026-02-05', 'Nómina febrero',          'Transferencia', 'nomina_feb_tecnologia.pdf'),
(3,  1, 2, 5,  3, 3500000.00,  '2026-01-10', 'Licencias Adobe',         'Tarjeta',       'licencias_adobe.pdf'),
(4,  1, 3, 4,  3, 800000.00,   '2026-01-15', 'Papelería',               'Efectivo',      'papeleria_ene.pdf'),
(5,  1, 1, 4,  1, 250000.00,   '2026-03-10', 'Papelería',               'Efectivo',      'papeleria_mar.pdf'),
(6,  2, 4, 8,  4, 12000000.00, '2026-01-03', 'Compra productos',        'Transferencia', 'compra_ene.pdf'),
(7,  2, 5, 9,  5, 3500000.00,  '2026-01-08', 'Flete nacional',          'Efectivo',      'flete_ene.pdf'),
(8,  2, 4, 8,  4, 14500000.00, '2026-02-05', 'Compra productos',        'Transferencia', 'compra_feb.pdf'),
(9,  3, 6, 11, 6, 25000000.00, '2026-01-07', 'Cemento y arena',         'Transferencia', 'materiales_ene.pdf'),
(10, 3, 6, 11, 6, 32000000.00, '2026-02-05', 'Hierro y acero',          'Transferencia', 'materiales_feb.pdf'),
(11, 3, 7, 12, 6, 3800000.00,  '2026-01-22', 'Alquiler retroexcavadora','Transferencia', 'alquiler_ene.pdf');

INSERT INTO ingreso (id_ingreso, id_empresa, id_categoria, id_usuario, monto, fecha, descripcion, fuente) VALUES
(1, 1, 1,  1, 25000000.00,  '2026-01-15', 'Venta de software corporativo',          'Cliente Bancolombia'),
(2, 1, 1,  2, 18000000.00,  '2026-02-10', 'Licencias anuales',                      'Cliente Grupo Éxito'),
(3, 1, 2,  1, 5000000.00,   '2026-03-05', 'Consultoría en transformación digital',  'Empresa XYZ'),
(4, 1, 1,  3, 32000000.00,  '2026-03-20', 'Venta de hardware especializado',        'Cliente Protección'),
(5, 2, 6,  4, 45000000.00,  '2026-01-10', 'Venta de productos perecederos',         'Supermercados Éxito'),
(6, 2, 6,  5, 38000000.00,  '2026-02-12', 'Venta de productos',                     'Supermercados Carulla'),
(7, 2, 7,  4, 6000000.00,   '2026-03-15', 'Servicio de distribución',               'Restaurantes'),
(8, 3, 10, 6, 85000000.00,  '2026-01-05', 'Proyecto Torres del Parque',             'Constructora ABC'),
(9, 3, 10, 6, 120000000.00, '2026-02-20', 'Proyecto Centro Comercial',              'Inversiones XYZ');

-- CORRECCIÓN: en tu export, los gastos de enero del análisis 1 decían 8000000,
-- pero la suma real de gastos de la empresa 1 en enero es 12300000 (8000000 + 3500000 + 800000).
INSERT INTO analisis_financiero (id_analisis, id_empresa, id_usuario_genera, fecha_analisis, tipo_analisis, resultado) VALUES
(1, 1, 1, '2026-03-25 13:01:11', 'comparativo_mensual',
   '{"periodos": ["Enero", "Febrero", "Marzo"], "gastos": [12300000, 8200000, 250000], "ingresos": [25000000, 18000000, 37000000], "tendencia": "creciente"}'),
-- Este análisis es coherente solo si el periodo evaluado es enero (gasto de Ventas empresa 2 en enero = 12000000).
(2, 2, 4, '2026-03-25 13:01:11', 'alertas_presupuesto',
   '{"departamentos": [{"nombre": "Ventas", "gastado": 12000000, "presupuesto": 18000000, "porcentaje": 67}], "recomendaciones": ["Todo dentro del presupuesto"]}'),
(3, 3, 6, '2026-03-25 13:01:11', 'alertas',
   '{"departamentos": [{"nombre": "Obras", "gastado": 57000000, "presupuesto": 35000000, "porcentaje": 163, "alerta": true}], "recomendaciones": ["Revisar gastos del departamento de Obras"]}');

INSERT INTO reporte (id_reporte, id_empresa, id_usuario_genera, fecha_generacion, tipo_reporte, parametros, archivo) VALUES
(1, 1, 1, '2026-03-25 13:01:11', 'mensual',         '{"mes": 1, "anio": 2026, "departamentos": ["Ventas", "Tecnología"]}',                     'reporte_enero_2026.pdf'),
(2, 2, 4, '2026-03-25 13:01:11', 'mensual',         '{"mes": 2, "anio": 2026}',                                                               'reporte_febrero_2026.pdf'),
(3, 3, 6, '2026-03-25 13:01:11', 'por_departamento','{"idDepartamento": 6, "fechaInicio": "2026-01-01", "fechaFin": "2026-03-31"}',           'reporte_obras_Q1.pdf');
