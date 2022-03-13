# taskillity
Proyecto colaborativo de DAW.

## Requisitos Desarrollo en el Entorno Servidor

- [X] __RA5__: Implementado con Symfony
- [ ] __RA7__: API REST que permita hacer CRUD de alguna entidad (usuarios, noticias...)
- [ ] __RA8__: Uso de AJAX
- [ ] __RA9__: Uso de servivio externo (Google, APIs externas, Twitter...)

## Requisitos Desarrollo en el Entorno Cliente

- [ ] __RA5__: Objeto form, objetos relacionados con eventos, eventos, envíos y validación de formularios..etc. No tenéis que tocar todas las partes sino trabajar algún aspecto relacionado con formularios, eventos, validación... Por ejemplo formularios de contacto, formularios de alta y cosas de este tipo 
- [ ] __RA6__: Modelo de objetos DOM: objetos, acceso (esto ya lo hemos usado en clase), gestión de eventos (algunos/as ya lo han usado)
- [ ] __RA7__: AJAX: envío y recepción de datos de forma asíncrona.

## Requisitos Despliegue de Aplicaciones Web

- [ ] __RA4__: Transferencia de archivos. Subir código fuente a __Heroku__
- [ ] __RA5__: Parámetros de configuración. Configurar variables necesarias: __URI__ de base datos, ...
- [ ] __RA6__: Documentación y control de versiones con __Git__. Desarrollo con __Markdown__ de README.md 

## Requisitos Empresa e Iniciativa Emprendedora

- [ ] __RA1__: Iniciativa emprendedora, ideación y  prototipados de la idea. Actitudes personales y profesionales (fase I del proyecto de empresa)
- [ ] __RA2__: Análisis del entorno de una actividad. (Fase II Del proyecto de empresa)
- [ ] __RA3__: Puesta en marcha de una empresa. Determinación del mercado, elementos de marketing, forma jurídica y obligaciones legales (Fase lV y V del plan de empresa) 
- [ ] __RA4__: Gestión administrativa y económica-financiera (fase VI del proyecto de empresa). 

# Taskillity

_Taskillity es una web de administración de proyectos con interfaz web que, por medio de tareas permite organizar actividades, tanto para trabajos personales como también para trabajos colaborativos. Totalmente orientada a estudiantes de desarrollo._

## Pre-requisitos 📋

_Requisitos y como instalarlos._

### PHP 8.1
Instalación:

1#
```
sudo apt update; 
```
2#
```
sudo apt upgrade
```
3#
```
sudo apt install ca-certificates apt-transport-https software-properties-common
```
4#
```
sudo add-apt-repository ppa:ondrej/php
```
5#
```
sudo apt install php8.1
```

### Symfony 6

Instalación:

[Guía Instalar Symfony](https://www.osradar.com/install-symfony-ubuntu-20-04/)


## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

_Clonamos el proyecto_
```
git clone https://github.com/Taskillity/taskillity.git
```

_Instalamos dependencias con composer_
```
composer install
```
_Si no ha creado el .env_
```
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"

```

_Después ejecutamos_
```
php bin/console make:migration
```

```
php bin/console doctrine:migrations:migrate
```

## Construido con 🛠️

_Herramientas utilizadas._

* [Symfony](https://symfony.com/) - El framework web usado.
* [Bootstrap](https://getbootstrap.com/) - Biblioteca utilizada.


## Autores ✒️

* **Christian Prieto Gómez** - [ChristianPrieto](https://github.com/ChristianPrieto)
* **Francisco Veragua Cabrera** - [fco-veragua](https://github.com/fco-veragua)
* **José Javier Gómez Jiménez** - [Joseja0202](https://github.com/Joseja0202)
* **Oscar García Gómez** - [oscargargom](https://github.com/oscargargom)  | [oscargargom001](https://github.com/oscargargom001)



## Licencia 📄

Este proyecto está bajo la Licencia Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0).



