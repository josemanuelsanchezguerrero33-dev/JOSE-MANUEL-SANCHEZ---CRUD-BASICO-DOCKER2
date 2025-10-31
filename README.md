# Parcial práctico avanzado — Proyecto Docker (PHP + MySQL)

Este proyecto contiene una aplicación PHP sencilla (sin framework) que lista y agrega usuarios, con MySQL como base de datos, y está preparada para ejecutarse con Docker.

Estructura:

project-root/
├─ app/
│  ├─ index.php
│  ├─ users.php
│  └─ Dockerfile
├─ db/
│  └─ init.sql
├─ docker-compose.yml
├─ .env.example
└─ README.md

Instrucciones rápidas

1) Copia `.env.example` a `.env` y actualiza las credenciales (especialmente `DB_ROOT_PASSWORD`).

2) Construir la imagen localmente y subir a Docker Hub (reemplaza `usuario_dockerhub`):

```bash
docker build -t usuario_dockerhub/php-app:1.0 ./app
docker push usuario_dockerhub/php-app:1.0
```

3) Iniciar con docker-compose:

```bash
docker compose up -d
```

4) Acceder a la aplicación en http://localhost:8081

Notas:
- El servicio `db` monta `./db` en `/docker-entrypoint-initdb.d` para inicializar la base de datos la primera vez.
- El Dockerfile usa `php:8.2-apache` y habilita `pdo_mysql`.
# JOSE-MANUEL-SANCHEZ---CRUD-BASICO-DOCKER2
# JOSÉ-MANUEL-SÁNCHEZ---CRUD-BASICO-DOCKER2
# JOSE-MANUEL-SANCHEZ---CRUD-BASICO-DOCKER2
