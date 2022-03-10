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

### Participantes

- Christian Prieto Gómez ► [ChristianPrieto](https://github.com/ChristianPrieto)
- Francisco Veragua Cabrera ► [fco-veragua](https://github.com/fco-veragua)
- José Javier Gómez Jiménez ► [Joseja0202](https://github.com/Joseja0202)
- Oscar García Gómez ► [oscargargom](https://github.com/oscargargom)  


# Taskillity

_Aquí describimos el proyecto._

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

_Clonamos el proyecto_
```
git clone https://github.com/Taskillity/taskillity.git
```

_Instalamos composer_
```
composer install
```
_Si no ha creado el .env_
```
DATABASE_URL="mysql://taskillity:taskillity@127.0.0.1:3306/taskillity?serverVersion=5.7"
```

_Después ejecutamos_
```
php bin/console make:migration
```

```
php bin/console doctrine:migrations:migrate
```

### Pre-requisitos 📋

_Que cosas necesitas para instalar el software y como instalarlas_

```
Da un ejemplo
```





### Instalación 🔧

_Una serie de ejemplos paso a paso que te dice lo que debes ejecutar para tener un entorno de desarrollo ejecutandose_

_Dí cómo será ese paso_

```
Da un ejemplo
```

_Y repite_

```
hasta finalizar
```

_Finaliza con un ejemplo de cómo obtener datos del sistema o como usarlos para una pequeña demo_


## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Symfony](https://symfony.com/) - El framework web usado
* [Maven](https://maven.apache.org/) - Manejador de dependencias
* [ROME](https://rometools.github.io/rome/) - Usado para generar RSS


## Versionado 📌

Usamos [SemVer](http://semver.org/) para el versionado. Para todas las versiones disponibles, mira los [tags en este repositorio](https://github.com/tu/proyecto/tags).

## Autores ✒️

* **Christian Prieto Gómez** - [ChristianPrieto](https://github.com/ChristianPrieto)
* **Francisco Veragua Cabrera** - [fco-veragua](https://github.com/fco-veragua)
* **José Javier Gómez Jiménez** - [Joseja0202](https://github.com/Joseja0202)
* **Oscar García Gómez** - [oscargargom](https://github.com/oscargargom)  | [oscargargom001](https://github.com/oscargargom001)



## Licencia 📄

Este proyecto está bajo la Licencia Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0) - mira el archivo [LICENSE.md](LICENSE.md) para detalles.







