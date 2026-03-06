# Tema IMCO - Entorno de Desarrollo Local

Entorno Docker que espeja producción (AWS Lightsail / Bitnami WordPress).

| Componente | Produccion | Local |
|---|---|---|
| WordPress | 6.8.3 | 6.8.x |
| PHP | 7.4.15 | 7.4 |
| Web Server | Apache (Bitnami) | Apache |
| Base de datos | MariaDB | MariaDB 10.5 |
| OS | Debian Linux | Contenedor Debian |

---

## Requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Git](https://git-scm.com/)
- Acceso SSH al servidor Lightsail (clave `.pem`)

---

## 1. Primer uso: clonar el repo y configurar

```bash
git clone <url-del-repo>
cd tema_IMCO

# Crear archivo de variables de entorno
cp .env.example .env
# (editar .env con tus passwords si lo deseas)
```

---

## 2. Traer el tema desde el servidor de produccion

Ejecuta este comando desde tu maquina local (reemplaza la ruta a tu clave `.pem`):

```bash
scp -r -i /ruta/a/LightsailDefaultKey-us-east-1.pem \
  bitnami@107.21.111.22:/home/bitnami/www.imco.org.mx/wp-content/themes/imco \
  ./imco
```

> En Windows con Git Bash o WSL el comando es el mismo.

---

## 3. Levantar el entorno Docker

```bash
docker compose up -d
```

Servicios disponibles:

| Servicio | URL |
|---|---|
| WordPress | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |

La primera vez WordPress mostrara el instalador. Completa la instalacion y activa el tema **IMCO** desde Apariencia > Temas.

---

## 4. Flujo de trabajo diario

```bash
# Iniciar
docker compose up -d

# Detener (conserva datos)
docker compose stop

# Detener y eliminar contenedores (conserva volumenes)
docker compose down

# Eliminar TODO incluyendo la base de datos
docker compose down -v
```

Los archivos del tema en `./imco/` se sincronizan en tiempo real con el contenedor.
Edita directamente en `./imco/` y los cambios se reflejan de inmediato en http://localhost:8080.

---

## 5. Subir cambios a GitHub

```bash
git add imco/
git commit -m "descripcion del cambio"
git push origin main
```

---

## 6. Importar base de datos de produccion (opcional)

Para tener el contenido real de produccion de forma local:

```bash
# 1. Exportar desde produccion
ssh -i /ruta/clave.pem bitnami@107.21.111.22 \
  "cd /home/bitnami/www.imco.org.mx && wp db export /tmp/imco_prod.sql --allow-root"

# 2. Descargar el dump
scp -i /ruta/clave.pem bitnami@107.21.111.22:/tmp/imco_prod.sql ./imco_prod.sql

# 3. Importar al contenedor Docker
docker compose exec db mariadb -u wp_user -pwp_password_local wordpress_imco < imco_prod.sql

# 4. Actualizar URLs en la BD (produccion -> local)
docker compose exec wordpress wp search-replace \
  'https://imco.org.mx' 'http://localhost:8080' \
  --allow-root
```

---

## Estructura del repositorio

```
tema_IMCO/
├── docker-compose.yml      # Configuracion de servicios Docker
├── .env.example            # Plantilla de variables de entorno
├── .env                    # Variables locales (NO se sube a git)
├── .gitignore
├── README.md
└── imco/                   # Archivos del tema WordPress (versionados)
    ├── style.css
    ├── functions.php
    ├── index.php
    └── ...
```

---

## Produccion

- **Servidor**: AWS Lightsail `WP-Imco2.0` (ip: 107.21.111.22)
- **Tema en produccion**: `/home/bitnami/www.imco.org.mx/wp-content/themes/imco`
- **Panel**: https://imco.org.mx/wp-admin
