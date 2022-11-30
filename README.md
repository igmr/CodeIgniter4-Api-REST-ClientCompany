# CodeIgniter4 - Api REST - Cliente Empresa
---

<a name="contenido"></a>
## Contenido
* [Introducción](#introduccion)
* [Requerimientos](#requerimientos)
* [Descarga de repositorio](#repositorio)
* [Configuración de proyecto](#proyecto)
	* [Instalación de dependencias utilizando Composer](#composer)
	* [Exportar script sql a MySql](#mysql)
	* [Configuración de proyecto](#configuracion)
* [Crear servidor php](#servidor)


<a name="introduccion"></a>
## Introducción

Ejemplo sencillo utilizando el Framework php, **CodeIgniter 4** para crear una **Api REST** con el gestor de base de datos MySql.

[Contenido](#contenido)

<a name="requerimientos"></a>
## Requerimiento
* Php 7.4 o superior
* Composer
* Mysql
* CodeIgniter [Página Oficial](https://codeigniter.com/user_guide/intro/index.html)

[Contenido](#contenido)

<a name="repositorio"></a>
## Descarga de repositorio
Primero clonamos el proyecto
```bash
# SSH
git clone git@github.com:igmr/CodeIgniter4-Api-REST-ClientCompany.git
```
O

```bash
# HTTPS
git clone https://github.com/igmr/CodeIgniter4-Api-REST-ClientCompany.git
```

Accedemos al proyecto
```bash
cd CodeIgniter4-Api-REST-ClientCompany
```
[Contenido](#contenido)

<a name="proyecto"></a>
##Configuración de proyecto

<a name="composer"></a>
### Instalación de dependencias utilizando Composer

Ejecutar la siguiente instrucción para descargar las dependencias necesarias por medio de composer.

```bash
composer update
```
[Contenido](#contenido)

<a name="mysql"></a>
### Exportar script sql a MySql
#### Modelo entidad relacion
<img src="./doc/model.png" 
        alt="Modelo entidad relación"
        style="display: block; margin: 0 auto" />
#### Importar y exportar script SQL
Para importar script sql al gestor de base de datos MySql, lo podemos realizar mediante PhpMyAdmin, workbench o desde la linea de comando. El siguiente comando importa el script sql a MySql desde la linea de comandos

```bash
# Sintaxis
mysql -u <user_name> -p<password> < <path/script/sql>

# O
mysql -u <user_name> -p < <path/script/sql>

# Ejemplo
mysql -u root -p < ./doc/script.sql
```
Para realizar la operación inversa usaremos el siguiente comando
```bash
# Sintaxis
mysqldump -u <user_name> -p<password> <database> > <path/script/sql>

# O
mysqldump -u <user_name> -p <database> > <path/script/sql>

# Ejemplo
mysqldump -u root -p CodeIgniter4_Api_REST_Client_Company > ./script.sql
```

[Ír a Script SQL] (#scriptsql)


[Contenido](#contenido)

<a name="configuracion"></a>
## Configuración de proyecto

Abrimos el proyecto en nuestro editor de código de preferencia
```bash
# Accedemos al proyecto
cd FlightPHP-Api-REST-TodoList
# Abrimos el proyecto con Visual Studio Code
code .
# O también podemos abrirlo con sublime text
subl .
```

Duplicamos archivo `env` y lo renombramos `.env`

```bash
#CI_ENVIRONMENT = production
...
# app.baseURL = '' # Colocar la ruta base
...
# Descomentamos estas lineas y colocamos nuestras credenciales de MySQL
# database.default.hostname = localhost
# database.default.database = ci4
# database.default.username = root
# database.default.password = root
# database.default.DBDriver = MySQLi
# database.default.DBPrefix =
# database.default.port = 3306
...

```



<a name="servidor"></a>
### Consola

Después de configurar el archivo `.env`, crearemos la base de datos desde spark, para ello abriremos una terminal, ubicamos dentro del proyecto de CodeIgniter e ingresamos el siguiente comando

```bash
# Sintaxis
php spark db:create <DataBaseName>
# Ejemplo
php spark db:create CodeIgniter4_Api_REST_Client_Company

```

Después crearemos las migraciones y los seeders

```bash
# Ejecutar migraciones
php spark migrate
# Ejemplo
php spark db:seed InitSeed

```

Y finalmente levantamos el servidor desde Spark
```bash
php spark serve

```


### Carpetas

```bash
.
├── .vscode
│   └── settings.json
├── doc
│   ├── ModelER-todo.png
│   └── script.sql
├── src
│   ├── model
│   │   ├── ListModel.php
│   │   └── TaskModel.php
│   └── service
│       ├── BaseService.php
│       ├── ListService.php
│       └── TaskService.php
├── vendor
│   └── ...
├── .gitignore
├── .htaccess
├── composer.json
├── Config.php
├── index.php
└── README.md

```

<a name="scriptsql"></a>

```sql
--	*	-----------------------------------------------------------------------
--	*	Database CodeIgniter4_Api_REST_Client_Company
--	*	-----------------------------------------------------------------------
DROP DATABASE IF EXISTS CodeIgniter4_Api_REST_Client_Company;
CREATE DATABASE IF NOT EXISTS CodeIgniter4_Api_REST_Client_Company;
USE CodeIgniter4_Api_REST_Client_Company;

--	*	-----------------------------------------------------------------------
--	*	Drop table
--	*	-----------------------------------------------------------------------
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS company;
--	*	-----------------------------------------------------------------------
--	*	Table Company
--	*	-----------------------------------------------------------------------
CREATE TABLE company (
	id			int			NOT	NULL	AUTO_INCREMENT,
	name		varchar(65)	NOT	NULL	DEFAULT	'',
	uuid		varchar(65)	NOT	NULL	DEFAULT	'',
	state		varchar(65)	NOT	NULL	DEFAULT	'',
	country		varchar(65)	NOT	NULL	DEFAULT	'',
	city		varchar(65)	NOT	NULL	DEFAULT	'',
	street		varchar(65)	NOT	NULL	DEFAULT	'',
	number		varchar(65)	NOT	NULL	DEFAULT	'',
	postcode	varchar(65)	NOT	NULL	DEFAULT	'',
	created_at	timestamp	NOT NULL	DEFAULT	CURRENT_TIMESTAMP,
	updated_at	timestamp		NULL	DEFAULT	NULL,
	deleted_at	timestamp		NULL	DEFAULT	NULL,
	PRIMARY KEY (id),
	UNIQUE KEY id (id),
	UNIQUE KEY name (name),
	UNIQUE KEY uuid (uuid),
	UNIQUE KEY updated_at (updated_at),
	UNIQUE KEY deleted_at (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--	*	-----------------------------------------------------------------------
--	*	Table client
--	*	-----------------------------------------------------------------------
CREATE TABLE client (
	id				int			NOT	NULL	AUTO_INCREMENT,
	company_id		int			NOT	NULL	DEFAULT	'0',
	full_name		varchar(86)	NOT	NULL	DEFAULT	'',
	user_name		varchar(65)	NOT	NULL	DEFAULT	'',
	phone			varchar(65)	NOT	NULL	DEFAULT	'',
	email			varchar(65)	NOT	NULL	DEFAULT	'',
	currency_code	varchar(10)	NOT	NULL	DEFAULT	'',
	uuid			varchar(65)	NOT	NULL	DEFAULT	'',
	created_at		timestamp	NOT	NULL	DEFAULT	CURRENT_TIMESTAMP,
	updated_at		timestamp	NULL		DEFAULT	NULL,
	deleted_at		timestamp	NULL		DEFAULT	NULL,
	PRIMARY KEY (id),
	UNIQUE KEY id (id),
	UNIQUE KEY phone (phone),
	UNIQUE KEY email (email),
	KEY client_company_id_foreign (company_id),
	CONSTRAINT client_company_id_foreign FOREIGN KEY (company_id) REFERENCES company (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--	*	-----------------------------------------------------------------------
--	*	Register Company
--	*	-----------------------------------------------------------------------

INSERT INTO company
VALUES
(1,'Switchable web-enabled forecast','4bdc39d6-cda9-3200-85c2-c6d11210bd57','Santa Cruz de Tenerife','Irlanda','Domingo del Barco','Ruela Brito','32','71050','2008-07-28 05:00:00','2022-11-30 15:45:01','2022-11-30 15:45:01'),
(2,'Self-enabling composite moratorium','bd0c6150-f64e-3b4e-928b-5153695e341f','Castellón','Vietnam','O Delapaz','Ruela Borrego','789','63163','1999-10-29 05:00:00',NULL,NULL),
(3,'Operative dynamic strategy','1cc4720a-9b3f-3b2c-997e-865c11ca3551','Sevilla','Sudáfrica','A Barragán','Rúa Parra','269','95191','1977-11-22 06:00:00',NULL,NULL),
(4,'Sharable heuristic syne','ce61c311-7aa8-3cb4-9f49-e8654f4efc57','Vizcaya','Birmania','Vall Domínquez del Bages','Avinguda Enríquez','2','56870','1977-01-20 06:00:00','2022-11-30 15:44:58',NULL),
(5,'Facetoface neutral approach','dd32d5a8-ccbd-3acb-a331-1307a7e8bb7b','Palencia','Irlanda','Los Nava','Plaza Roberto','61','85385','2013-02-10 06:00:00',NULL,NULL),
(6,'Intuitive fresh-thinking implementation','26b34a40-db3d-3f18-bf41-81d1e6b22e2d','Ceuta','Malta','L Téllez','Avenida Garrido','409','21343','2016-12-09 06:00:00',NULL,NULL),
(7,'Focused systematic orchestration','3b208b5b-b4da-3ba4-9077-fcf8ecf99514','Illes Balears','Ciudad del Vaticano','Salazar de Arriba','Travesía Camacho','7','96752','2003-08-28 05:00:00',NULL,NULL),
(8,'Ergonomic foreground product','8734fe2d-3f0a-3c9c-8814-556c5781786a','Huesca','Andorra','Los Bravo de la Sierra','Plaza Olga','571','28869','1980-07-16 06:00:00',NULL,NULL),
(9,'Open-source interactive array','a378a4f0-394f-3857-9301-a2fe01ae3c57','Segovia','Bosnia-Herzegovina','Villar de Arriba','Avinguda Mar','7','57597','1991-03-15 06:00:00',NULL,NULL),
(10,'Optimized nextgeneration groupware','3bd64585-e44b-3415-99f9-f36eaaff1ed7','Guadalajara','Liechtenstein','Los Valdez','Plaça Ayala','931','59115','1974-06-05 06:00:00',NULL,NULL),
(11,'Balanced eco-centric algorithm','ed384f78-5eb2-32f2-94f7-b3f680304327','Melilla','Tonga','Mesa Medio','Ruela Marc','83','61257','2019-05-11 05:00:00',NULL,NULL),
(12,'Customer-focused intangible challenge','a3c7f11e-8842-36f9-b8a0-ecfd80c3f690','Santa Cruz de Tenerife','Honduras','Bermúdez de la Sierra','Praza Jaime','899','54340','2015-11-06 06:00:00',NULL,NULL),
(13,'Managed zeroadministration knowledgeuser','8ce92ca5-8d69-3aaf-bcc0-d458468d7abb','Almería','Corea del Norte','Las Cuenca','Avenida Raya','548','01474','2021-07-24 05:00:00',NULL,NULL),
(14,'Balanced fault-tolerant migration','15d95db2-669d-39fb-ad0b-932b2a67a491','Cantabria','Andorra','Las Puente','Paseo Moral','965','63724','1972-04-08 06:00:00',NULL,NULL),
(15,'Synergized static GraphicalUserInterface','fcc33f68-da1d-3152-ac3d-3aa0c6671ef2','Salamanca','Antigua y Barbuda','Las Baeza','Plaza Luis','29','93628','1972-06-11 06:00:00',NULL,NULL),
(16,'Exclusive heuristic frame','979c25d2-98f1-3876-8ee5-881b5cdae9a8','Almería','Zambia','O Polo del Puerto','Plaza Iker','5','46541','1979-03-12 06:00:00',NULL,NULL),
(17,'Programmable actuating intranet','b162d3b6-1085-360d-acfc-60f0351e33c9','Cuenca','Uruguay','Villa Polo del Vallès','Travessera Madrigal','9','00561','1985-10-30 06:00:00',NULL,NULL),
(18,'De-engineered stable encryption','fc82a01c-2afc-319d-9539-b3b84ee2ce0a','Barcelona','Burundi','Grijalva del Barco','Plaça Rafael','86','10828','1972-08-03 06:00:00',NULL,NULL),
(19,'Ameliorated empowering data-warehouse','e25bb15b-f7cd-3105-9740-d44a44aa9225','Guadalajara','Palaos','As Lozada del Puerto','Praza Tejeda','34','39953','1992-11-03 06:00:00',NULL,NULL),
(20,'Multi-channelled context-sensitive help-desk','54b89e7a-3c0d-38a7-b24e-614b90f85249','Pontevedra','Noruega','A Leiva de las Torres','Camino Bañuelos','52','53233','2003-03-29 06:00:00',NULL,NULL),
(21,'Total exuding help-desk','d49707ae-a829-39de-8ab9-29a053063407','Burgos','Zimbabue','De Anda del Barco','Travessera Iglesias','6','71196','2014-03-23 06:00:00',NULL,NULL),
(22,'Business-focused exuding contingency','18b20533-0c07-3885-ab22-4ade9c3e4d6a','Soria','Gabón','L  Viera de las Torres','Camiño Torres','49','93224','1978-01-31 06:00:00',NULL,NULL),
(23,'Quality-focused heuristic ability','e14bfbef-edb7-327a-b72c-22fa79d11115','Huesca','Mali','Granado Baja','Praza Ros','9','41420','1985-12-31 06:00:00',NULL,NULL),
(24,'Reactive actuating throughput','9e0d4977-73d3-3d56-aec9-3a8af2a76561','Huelva','Vietnam','As Anguiano de las Torres','Ruela Arredondo','17','96056','2021-03-03 06:00:00',NULL,NULL),
(25,'Cloned hybrid circuit','7c7d9419-f7d3-360f-8306-5dfbcbbb0369','Ciudad Real','Santo Tomé y Príncipe','Montes de las Torres','Camino Padrón','578','39882','1980-12-04 06:00:00',NULL,NULL),
(26,'Stand-alone foreground migration','170efdd8-b803-3222-b0c1-cf4b3137c808','Santa Cruz de Tenerife','Cabo Verde','San Bahena','Camiño Solano','5','65568','1977-03-09 06:00:00',NULL,NULL),
(27,'Managed bi-directional GraphicInterface','86c41887-5076-3e12-ba89-d4dba390011b','Ávila','El Salvador','Las Samaniego','Calle Aleix','20','64523','1979-08-13 06:00:00',NULL,NULL),
(28,'Seamless exuding initiative','5f0af3fe-9a9e-358b-9231-d5964732da3b','Barcelona','Nepal','Guardado de Arriba','Plaça Yeray','2','77994','2000-08-24 05:00:00',NULL,NULL),
(29,'Organized 24/7 website','03997525-620b-32c4-a29d-f53753e519a5','Guadalajara','Chipre','Corral de Arriba','Camino Andrés','821','35827','1983-08-18 06:00:00',NULL,NULL),
(30,'Virtual dedicated utilisation','03ba934f-d468-36be-afe0-fb925843e65a','Cuenca','Suiza','O Valadez','Ronda Paula','982','09853','1998-05-24 05:00:00',NULL,NULL),
(31,'Switchable national securedline','8b20c337-7e7b-3bcc-addf-cd6d91488254','Salamanca','Corea del Norte','Vall Andreu','Travesía Sauceda','64','93740','2021-09-26 05:00:00',NULL,NULL),
(32,'Cross-group dynamic archive','de2b6df4-1959-3534-ada6-87faab401ac9','Huelva','Lituania','O Tamayo del Penedès','Camino Jaime','241','46594','2010-10-28 05:00:00',NULL,NULL),
(33,'Reverse-engineered neutral superstructure','18726298-eca1-3373-8861-5d0fb1dd3daf','Zaragoza','Egipto','Cotto de las Torres','Ronda Rosas','405','60554','2002-10-27 05:00:00',NULL,NULL),
(34,'Multi-layered directional infrastructure','e26c306a-1528-352c-a0e6-022cd73ded94','Castellón','Maldivas','Os Villanueva Baja','Camiño Roig','983','98266','1971-05-08 06:00:00',NULL,NULL),
(35,'Proactive coherent instructionset','ef96d122-0edf-3092-ab10-1e08ed0d36f6','Santa Cruz de Tenerife','Camboya','San Carreón de San Pedro','Plaça Cuellar','34','55948','1978-10-21 06:00:00',NULL,NULL),
(36,'Cross-platform value-added analyzer','8b0103bc-01f2-3097-8dc1-42f0778d7b86','Almería','Rumanía','L Dueñas de Arriba','Paseo Estévez','4','81648','1978-12-09 06:00:00',NULL,NULL),
(37,'Customer-focused client-server toolset','5a535d54-16ab-32bb-9db1-678f32df35d2','Jaén','Botsuana','Herrero Medio','Praza Valeria','605','05699','1972-12-09 06:00:00',NULL,NULL),
(38,'Self-enabling non-volatile opensystem','a8715b7d-e8b1-3ae9-9b89-3ed10a5672d2','Zamora','Mozambique','San Mayorga','Ronda Barajas','518','42687','2009-08-01 05:00:00',NULL,NULL),
(39,'Expanded regional moratorium','f7a75613-893a-3298-bca8-35dd926f155c','León','Mongolia','Los Pérez de Ulla','Calle Iván','257','19680','1999-01-23 06:00:00',NULL,NULL),
(40,'Right-sized radical portal','f5bc29d2-3d02-3adc-9444-c9463671b65f','Cantabria','Jordania','La Orta','Plaça Galarza','6','99546','2006-03-23 06:00:00',NULL,NULL),
(41,'Seamless background service-desk','aa8a83cd-ab07-349b-95f6-e5a8db2402a6','Murcia','Birmania','Carranza Alta','Travesía Teresa','74','20030','1974-06-26 06:00:00',NULL,NULL),
(42,'Re-contextualized tertiary leverage','6094e110-e4a6-3619-9dc5-523e3640b14a','Illes Balears','Madagascar','Villa Vigil','Plaça Longoria','629','39575','1991-01-29 06:00:00',NULL,NULL),
(43,'Decentralized holistic collaboration','8b7de193-16eb-3d8d-9c15-1a9eff11f664','Palencia','Lituania','Covarrubias Baja','Camiño África','1','89421','1972-10-01 06:00:00',NULL,NULL),
(44,'Multi-layered static strategy','e6674608-1a6a-3b11-86a2-e986433359cc','Santa Cruz de Tenerife','Costa Rica','Vall Vega del Penedès','Rúa Pedraza','447','59335','1979-06-30 06:00:00',NULL,NULL),
(45,'Assimilated system-worthy localareanetwork','8f358495-1cc1-3bd6-aac1-d89c1c6a194d','Sevilla','Polonia','Bustamante de Lemos','Rúa Lebrón','97','64931','2020-10-15 05:00:00',NULL,NULL),
(46,'Quality-focused local emulation','062c23e1-0611-3575-9a68-0a93b63c8512','Santa Cruz de Tenerife','República Democrática del Congo','Ortega de Ulla','Calle Abril','13','04968','2006-01-29 06:00:00',NULL,NULL),
(47,'Streamlined content-based data-warehouse','8cc5f3e3-ba56-31c7-9d38-004ff7ecd476','Cuenca','Suazilandia','As Cuevas','Ronda Leo','766','31217','1994-02-23 06:00:00',NULL,NULL),
(48,'Implemented 24hour contingency','47fecddb-971b-34e1-bec5-a804a2734671','Granada','Belice','El Cabrera','Praza Pablo','631','67090','2015-03-25 06:00:00',NULL,NULL),
(49,'Implemented high-level challenge','463a8aac-82d3-31e2-84ec-a23444be5829','Salamanca','Mongolia','San Gamboa','Avenida Paula','743','44481','1980-07-26 06:00:00',NULL,NULL),
(50,'Down-sized maximized opensystem','485b0fd4-62f9-3faa-836b-de175e25c483','Burgos','Surinam','La Cintrón del Bages','Calle Estévez','6','62302','2003-03-04 06:00:00',NULL,NULL),
(51,'Synergistic well-modulated knowledgeuser','37116f5e-f5c2-3182-8b35-e5f9c968fd52','Lleida','Ucrania','L Delarosa del Penedès','Paseo Jan','5','36019','2002-01-09 06:00:00',NULL,NULL),
(52,'Horizontal neutral intranet','a7ad6cfe-c31f-3132-866b-abff1ad6389b','Granada','El Salvador','O Lozada','Avinguda De la Fuente','813','97199','2020-10-17 05:00:00',NULL,NULL),
(53,'Self-enabling secondary policy','7e06a41e-f084-3b6c-9157-8887043a3661','Huesca','Costa de Marfil','Almonte del Penedès','Carrer Eduardo','2','67294','1976-09-16 06:00:00',NULL,NULL),
(54,'Multi-channelled human-resource alliance','1fd5fded-fb9f-34bc-ad2b-fb4beaaefd37','Murcia','Maldivas','Villa Ceja','Plaza José Antonio','95','41392','1980-10-26 06:00:00',NULL,NULL),
(55,'Robust tangible data-warehouse','c1d8f4a8-d681-391e-9508-63a1687e8560','Illes Balears','Turkmenistán','Cervantes del Pozo','Ruela Ian','8','64219','2009-11-04 06:00:00',NULL,NULL),
(56,'Customer-focused exuding matrices','44d2b734-f907-3806-aac9-2574564562b0','Murcia','Islas Marshall','Los Macias','Carrer Luque','69','55541','2000-11-29 06:00:00',NULL,NULL),
(57,'Decentralized high-level matrix','52f62705-bf48-373a-8a26-1061162306ca','Cádiz','Kirguistán','Archuleta del Barco','Paseo Mascareñas','781','55008','1970-10-07 06:00:00',NULL,NULL),
(58,'Devolved multi-state adapter','67542d0d-4f50-39fd-b25f-16a00fad3e0e','Burgos','Palaos','Oquendo de Lemos','Rúa Daniel','37','32435','2021-05-06 05:00:00',NULL,NULL),
(59,'Integrated heuristic internetsolution','b5b6d32d-8f42-388f-840b-6a02ba8ad124','Salamanca','Tayikistán','Villa Luque','Calle Almonte','12','08942','1976-04-28 06:00:00',NULL,NULL),
(60,'Object-based human-resource architecture','76285499-be5d-3f78-8509-df1e4ceb567f','Zaragoza','Samoa','San Robles de las Torres','Praza Guillem','47','07802','1970-06-13 06:00:00',NULL,NULL),
(61,'Robust well-modulated help-desk','6b62585f-d583-3249-994f-bb774f67ef82','Burgos','Catar','O Olivera del Puerto','Plaza Luevano','93','73485','1990-01-20 06:00:00',NULL,NULL),
(62,'Realigned didactic implementation','daa2e126-f3c6-3b5d-91f8-5c8e4e4e69ce','Castellón','Noruega','Las Martínez','Praza Yolanda','92','33200','2007-11-11 06:00:00',NULL,NULL),
(63,'Business-focused mobile firmware','3c5c2f5e-df99-325a-8bbc-0919319fefd8','Huesca','Austria','El Lozano','Paseo Serna','493','42457','2018-03-18 06:00:00',NULL,NULL),
(64,'Assimilated exuding initiative','b1bfb060-c24e-3667-9bd9-dad2850afb62','Almería','Singapur','Los Barajas del Bages','Camino Iván','958','40715','1974-08-16 06:00:00',NULL,NULL),
(65,'Versatile optimal paradigm','cfbd9125-e0c4-3a24-8b36-641f69e585c4','Santa Cruz de Tenerife','Guyana','Figueroa Alta','Ronda Pol','69','06142','2021-07-21 05:00:00',NULL,NULL),
(66,'Organized methodical projection','b12fa3d5-6385-303e-96fc-3d61c1235b5c','Palencia','Camboya','A Fernández del Barco','Paseo Rocío','7','25667','2009-08-12 05:00:00',NULL,NULL),
(67,'Progressive human-resource core','5afe7fd8-eda3-32f1-bedb-7dffb80259bf','Vizcaya','Serbia','Leal Baja','Avinguda Adrián','515','21532','1985-04-06 06:00:00',NULL,NULL),
(68,'Secured coherent software','25698b19-169c-3070-a7a1-7479ef4bf8e5','Navarra','Chad','Dueñas del Bages','Ruela Javier','33','88637','2019-03-12 06:00:00',NULL,NULL),
(69,'Triple-buffered foreground knowledgebase','9534f950-dfd6-3b07-b8a4-66e288ecbf8c','Pontevedra','Túnez','El Pons','Ronda Bruno','9','55122','1984-03-06 06:00:00',NULL,NULL),
(70,'Networked stable flexibility','ac6b5dcb-fedc-320b-bca7-046f6dee89fe','Badajoz','Argelia','Carvajal Alta','Rúa Castañeda','202','61211','1982-09-15 06:00:00',NULL,NULL),
(71,'Enhanced incremental adapter','c986adf1-879b-3938-9e16-d1ae32bb8d34','La Rioja','Suecia','Fonseca del Vallès','Plaza Alex','2','29847','2003-10-05 05:00:00',NULL,NULL),
(72,'Customer-focused nextgeneration help-desk','ba2e4a0c-f630-36e1-a18a-0df292f043f3','Lugo','Francia','Henríquez del Pozo','Plaza Madera','450','70599','1997-01-14 06:00:00',NULL,NULL),
(73,'Managed user-facing interface','c48095e4-d95b-3eca-aac8-032774d72676','Cuenca','Barbados','Rangel del Penedès','Camino Costa','44','28251','1978-10-06 06:00:00',NULL,NULL),
(74,'Distributed empowering GraphicalUserInterface','8e271ff0-f23f-3a69-b29d-08c79cc28178','Cádiz','Corea del Norte','Arroyo del Pozo','Plaza Diana','280','19970','2021-04-13 05:00:00',NULL,NULL),
(75,'Diverse directional orchestration','fca85252-95f9-3231-a1e8-56543685dcb1','Toledo','Guatemala','Menéndez Medio','Travessera Díaz','53','40664','2002-02-13 06:00:00',NULL,NULL),
(76,'Progressive regional database','6590942a-55ae-3f2e-b9e5-e937a92ed4bf','Cáceres','Nueva Zelanda','Vall Nevárez','Ronda Gabriela','2','12867','1989-05-22 06:00:00',NULL,NULL),
(77,'Ergonomic web-enabled algorithm','71dc565e-0be6-305e-b1d6-0f082d8246b6','Jaén','Hungría','San Morán del Puerto','Camiño Caballero','78','15380','2005-05-06 05:00:00',NULL,NULL),
(78,'Organic national localareanetwork','7fdbabbe-fa50-3388-9659-a332f2493975','Jaén','Angola','A Alfaro','Camino Inmaculada','5','52328','1970-05-01 06:00:00',NULL,NULL),
(79,'Vision-oriented eco-centric emulation','82dd3791-eae7-3029-9c69-654fdaed59f5','Asturias','Angola','Cárdenas del Penedès','Calle Berta','79','10441','1982-06-03 06:00:00',NULL,NULL),
(80,'Inverse discrete software','e6db35b1-d041-3e0e-a469-efcea45d1316','Ourense','Estonia','Gutiérrez del Puerto','Camiño Juan','9','43146','2003-06-08 05:00:00',NULL,NULL),
(81,'Innovative solution-oriented policy','fe4cc794-3498-3adf-b70f-b31a9702559f','Castellón','Suecia','As Carrasco','Avinguda Dario','9','91332','1970-10-08 06:00:00',NULL,NULL),
(82,'Grass-roots zerotolerance product','024d36e5-f733-3b94-a5f8-50c49a342e88','Zamora','Surinam','Carballo del Bages','Paseo Ponce','954','21673','2001-10-30 06:00:00',NULL,NULL),
(83,'Compatible system-worthy frame','f29f2e07-bc9b-3d6e-aed5-6a7ea16f8db2','Soria','Laos','As Gallardo','Camiño José Antonio','69','56429','2016-01-26 06:00:00',NULL,NULL),
(84,'De-engineered uniform pricingstructure','ad8d5ba9-c8f0-3b48-9f1b-c01a65ed3cf2','Alicante','Suecia','San Barela','Paseo Velasco','92','05843','1979-03-22 06:00:00',NULL,NULL),
(85,'Universal static attitude','825bcff9-1a7f-3d48-b6d8-86521cf2d65c','Palencia','Ciudad del Vaticano','Velásquez del Penedès','Praza Rodrigo','91','48290','2022-04-13 05:00:00',NULL,NULL),
(86,'Centralized disintermediate throughput','02f67d61-14ca-3b53-96d2-d9c6c448b69e','Soria','Tanzania','L Piñeiro','Avenida Alvarado','52','83262','2022-06-19 05:00:00',NULL,NULL),
(87,'Right-sized modular orchestration','974d0062-90bc-3b6c-b3be-312bfb1e32a5','Navarra','Zambia','San Soto Baja','Praza Roig','14','59048','2011-02-24 06:00:00',NULL,NULL),
(88,'Customizable homogeneous processimprovement','56bc5199-0c1c-3a8d-b060-6606cd4c67b5','Vizcaya','Chile','As Silva','Calle Mireia','637','45233','1993-12-11 06:00:00',NULL,NULL),
(89,'Horizontal leadingedge customerloyalty','ec790633-02ee-39e2-915c-8c27bc443c6f','Sevilla','Botsuana','As Pedraza','Plaza Oquendo','2','41655','1988-01-25 06:00:00',NULL,NULL),
(90,'Streamlined coherent attitude','049b02c7-582b-3db8-8e1d-27bbd0ef1ed2','Madrid','Moldavia','San Caro','Praza Ozuna','443','14850','1989-04-30 06:00:00',NULL,NULL),
(91,'Grass-roots web-enabled systemengine','376315e0-a855-3af1-a95b-820e2d84a485','Zamora','Turquía','Los Pichardo','Ronda Ríos','46','12795','2022-04-13 05:00:00',NULL,NULL),
(92,'Re-contextualized disintermediate pricingstructure','fab4f116-48e1-3c35-95be-07ed5a2f157a','Álava','Azerbaiyán','El Adorno','Calle Villaseñor','8','66000','1976-04-01 06:00:00',NULL,NULL),
(93,'Customizable dynamic groupware','31707c1f-0828-3753-a006-cb03c05689f4','Jaén','Chile','As Niño','Carrer Bustos','98','58090','1978-03-30 06:00:00',NULL,NULL),
(94,'Distributed fresh-thinking application','b0844002-850f-3981-a7e6-859ccb71eff8','Illes Balears','Bulgaria','Simón del Vallès','Passeig Acuña','37','43171','1991-10-29 06:00:00',NULL,NULL),
(95,'Quality-focused full-range archive','d97de29e-cfa8-3e09-b852-72c65d21284e','Castellón','Kuwait','As Calvo de Arriba','Plaça Guerra','227','61030','2015-05-15 05:00:00',NULL,NULL),
(96,'Devolved mission-critical core','8dbe2bc9-f3c6-3938-a9e3-17317443d236','Castellón','Guinea-Bisáu','Los Cruz del Pozo','Avinguda Vargas','224','28017','1999-12-12 06:00:00',NULL,NULL),
(97,'Visionary foreground database','ef560b20-8f6e-31f7-8ced-6a008c11f4ff','Zaragoza','Tanzania','Rodríguez Medio','Ronda Ana Isabel','446','71221','1970-04-14 06:00:00',NULL,NULL),
(98,'Horizontal systematic contingency','952e70aa-b7ea-3a0a-a0ec-75eec6c4ed27','Santa Cruz de Tenerife','Ecuador','La Vergara del Vallès','Plaza Ángel','1','38390','2018-06-18 05:00:00',NULL,NULL),
(99,'Profit-focused scalable standardization','b362698a-f455-3302-92c3-0d95953724ea','Murcia','Santo Tomé y Príncipe','Los Crespo de Arriba','Passeig Guillem','925','25394','2017-06-17 05:00:00',NULL,NULL),
(100,'Reactive 3rdgeneration hardware','e84a0014-aa49-3df9-85e4-11b9447c2714','Zamora','Bosnia-Herzegovina','Las Marcos','Camiño Sánchez','465','77705','2009-08-06 05:00:00',NULL,NULL),
(101,'Sharable heuristic synergys','63877a75ded1a','Valladolid','Mónaco','De Anda de Arriba','Plaça Nadia','6','87878','2022-11-30 15:44:53','2022-11-30 15:44:53',NULL);


--	*	-----------------------------------------------------------------------
--	*	Register client
--	*	-----------------------------------------------------------------------

INSERT INTO client
VALUES
(1,45,'Lic. Helena Samaniego','qsoria','994 509649','alexia.escudero@latinmail.com','OMR','03803de7-389d-3fea-9650-8755a1313faf','2010-07-04 05:00:00',NULL,NULL),
(2,48,'Lucía Terán','ignacio00','+34 963869991','diana20@hispavista.com','THB','78804302-71e8-32b4-9066-908e245aed70','2000-03-14 06:00:00','2022-11-30 15:32:15','2022-11-30 15:32:15'),
(3,12,'D. Francisco Javier Páez','rcontreras','961 86 7856','david03@live.com','BSD','45fadf39-3d55-3fc3-840a-db63fea09f89','2022-04-24 05:00:00',NULL,NULL),
(4,7,'Marcos Arguello Hijo','david.pozo','+34 923 46 1098','malak.lomel@hotmail.com','SGD','90e82a34-ea0c-30d3-bf68-5d9fad55c5ba','2011-03-15 06:00:00','2022-11-30 15:28:21',NULL),
(5,20,'Andrés Vera','yaiza.ordonez','910-57-3917','gerard46@hotmail.com','TRY','c6060ea5-5382-3fde-9d6f-15d719a67ee5','2021-10-15 05:00:00',NULL,NULL),
(6,7,'Sofía Cortés','olivera.omar','+34 902318321','lucero.alejandra@latinmail.com','SOS','c883f0b8-02e2-3f63-9945-c74e936a246e','2000-11-20 06:00:00',NULL,NULL),
(7,48,'Ángeles Urbina Segundo','cristian04','+34 982-582043','gabriela50@live.com','LYD','caa59e93-5845-3628-bb37-d24d7921c666','2015-03-21 06:00:00',NULL,NULL),
(8,33,'Natalia Saavedra','francisca.arteaga','900-27-9385','tijerina.adriana@gmail.com','LSL','b34711f1-e992-39c7-a4c1-0aa7fa7788e3','1972-09-13 06:00:00',NULL,NULL),
(9,40,'Luis Piña','zamudio.daniela','937-399517','anaisabel.cobo@gmail.com','UAH','b3d94a07-1b92-3dea-96dc-2d64031d50b3','1994-12-30 06:00:00',NULL,NULL),
(10,50,'Ing. Jorge Alonso','lsandoval','961-377607','pablo87@gmail.com','SOS','0f53e4ef-bd54-30ae-957c-dece038cdf33','2014-02-17 06:00:00',NULL,NULL),
(11,48,'Alexia Ponce','gabriela.puga','967 715376','lucas46@terra.com','TRY','c579e7ac-786b-37a8-8464-7fd0e8fda2a5','1970-05-01 06:00:00',NULL,NULL),
(12,49,'Gerard Orosco','avalos.oriol','965 953404','garrido.victoria@hotmail.com','PHP','ce020fe8-6fa5-3914-b536-21d2640fbd03','2012-06-18 05:00:00',NULL,NULL),
(13,8,'Iker Valentín','rico.roberto','+34 969 05 5278','angeles.matos@latinmail.com','GBP','f317db4d-0e74-3627-8034-d5a3c466978c','1987-07-05 06:00:00',NULL,NULL),
(14,45,'Dr. Zoe Ferrer','ztoro','994 877568','javier.arteaga@hotmail.com','LRD','07ae501e-e0fc-352a-a66d-420ee89cd66c','1977-02-13 06:00:00',NULL,NULL),
(15,46,'Gael Salcedo','joel.cano','975 64 8535','pablo67@hotmail.com','MXN','3a981b6f-2826-3756-9e1f-2bebf3dac4d8','1989-04-14 06:00:00',NULL,NULL),
(16,21,'Emilia Gallardo','margarita87','907 12 1654','francisco11@yahoo.com','CNY','599fda41-73c9-370b-a685-e130d677d1ef','2013-01-29 06:00:00',NULL,NULL),
(17,26,'Gabriel Asensio','bruno.barraza','970 841912','elsa.farias@hispavista.com','ISK','fe5fcd43-8be3-336e-bc05-e2bd76a800ba','1975-05-13 06:00:00',NULL,NULL),
(18,40,'Iker Regalado','saul74','981 691238','alma.hinojosa@hispavista.com','GIP','be5c70e3-b62c-363d-9b90-cb675e105106','1998-02-11 06:00:00',NULL,NULL),
(19,10,'Alex Maestas Tercero','hfrias','933 206943','msantillan@hotmail.es','KHR','1973402e-85f8-3cd4-becc-64b4dd3e16ad','1973-05-19 06:00:00',NULL,NULL),
(20,29,'Sra. Juana Saiz Hijo','paula.noriega','+34 931-890703','pros@yahoo.com','KMF','7586dc4b-e53c-33eb-9c11-20e835a37079','1996-02-02 06:00:00',NULL,NULL),
(21,9,'Josefa Villaseñor','miriam93','+34 969 95 6428','osorio.lara@live.com','UYU','e1be1e4e-1054-364e-9eba-0a463ffc1027','1977-06-19 06:00:00',NULL,NULL),
(22,44,'Jan Almonte Tercero','izan.mascarenas','964-844973','kbarajas@hispavista.com','RUB','b536bbf9-26f1-3741-8115-7e777c1f15ce','2012-07-30 05:00:00',NULL,NULL),
(23,44,'Jaime Redondo','esteve.alexandra','+34 982-181623','luis73@live.com','BHD','fc33a848-d31b-310f-9f9f-708ae918f9b7','1989-02-16 06:00:00',NULL,NULL),
(24,3,'Ing. Roberto Miguel Segundo','ursula.caballero','+34 993 993910','daniela14@hotmail.es','ANG','2d1e219f-5ecc-3294-a1f3-7386e8b3d965','1989-07-31 06:00:00',NULL,NULL),
(25,49,'Sofía Arroyo','aviles.sofia','968 19 7745','hidalgo.gabriela@hotmail.es','MAD','51c707dd-d5e9-3d41-ad6c-4e01684a4da4','2001-10-08 06:00:00',NULL,NULL),
(26,3,'Dr. Raúl Tapia Hijo','imontalvo','+34 967416542','ainara66@yahoo.com','INR','953c5437-69d9-3a7a-a54b-a78b0a7595b0','1997-12-15 06:00:00',NULL,NULL),
(27,19,'Aaron Uribe','vila.manuela','+34 930 35 9281','jmedina@yahoo.es','HTG','2118c245-b797-3b9b-81e1-c44814d68c9f','1982-10-19 06:00:00',NULL,NULL),
(28,4,'Aaron Cavazos','marta13','+34 971317744','roberto.garcia@terra.com','NAD','1acd3fe0-2bf7-31ec-af17-3f822ee28c48','1981-06-13 06:00:00',NULL,NULL),
(29,42,'Rodrigo Ulibarri','joseantonio.moreno','932-85-2147','salma41@yahoo.com','ZMW','a8eb899b-b7d0-37fe-aac0-789f76c01041','1985-03-01 06:00:00',NULL,NULL),
(30,7,'Manuel Velasco','bblazquez','930236529','qmoran@yahoo.com','SGD','44905a4b-e0cf-3b45-810c-16e6c949a17c','2014-09-02 05:00:00',NULL,NULL),
(31,5,'Víctor Arguello','peres.francisco','+34 916 347487','daniela.lozano@gmail.com','SEK','8ff786d4-0672-3144-b81f-a7ccce241801','1988-07-12 06:00:00',NULL,NULL),
(32,2,'Eva Barroso','manzano.santiago','964 97 5844','rnaranjo@hotmail.es','UGX','248f1ed2-b5ca-35e8-a156-a5a30a6c6e56','1979-02-06 06:00:00',NULL,NULL),
(33,41,'Jorge Cantú','yeray.escamilla','+34 994 12 5404','qharo@hotmail.es','TWD','b169e6b9-b988-33f4-9738-96849c6d2055','2004-08-14 05:00:00',NULL,NULL),
(34,17,'Adam Guillen','mdiez','961-908432','samuel43@live.com','BND','3c1efe6b-765c-3630-8e4e-d9e7a6e3d944','2007-10-15 05:00:00',NULL,NULL),
(35,18,'Sr. Enrique Carballo','rcortes','984 885793','alma80@gmail.com','CRC','8acb4229-3f1b-3216-ba96-3acacf866e47','2022-06-08 05:00:00',NULL,NULL),
(36,36,'Dr. Samuel Godínez Tercero','espinal.aleix','+34 911 728772','claudia20@yahoo.es','MGA','8b161e2d-4b9b-3333-b77d-788912f10a92','2020-04-11 05:00:00',NULL,NULL),
(37,44,'Elsa Rolón','collazo.pedro','+34 935-606153','maria.carrion@yahoo.es','DJF','1022ed4f-5071-3795-b6e9-650d65581448','2016-07-02 05:00:00',NULL,NULL),
(38,50,'Marcos Medina Hijo','lverduzco','970-37-1620','miriam.ruelas@latinmail.com','QAR','dd8c7c48-4639-3e37-86b0-1019505905fc','2022-09-28 05:00:00',NULL,NULL),
(39,22,'Marco Bermúdez','aitana30','+34 965 621464','iverduzco@yahoo.es','SBD','2eb2482f-07d8-321f-8db2-96477bbac9ae','1971-11-02 06:00:00',NULL,NULL),
(40,41,'Isaac Puga','gloria.soria','+34 945-806192','mendoza.alejandra@hotmail.com','BSD','91a61f47-a71b-3161-8743-f4dd06718225','1985-05-17 06:00:00',NULL,NULL),
(41,44,'Aurora Guerrero Segundo','cbarreto','+34 915 53 5022','paula.montoya@gmail.com','UYU','5863a337-a542-3ca7-a594-7d06584f56bc','2003-08-16 05:00:00',NULL,NULL),
(42,16,'Carla Soriano','sara.llorente','947 757759','fatima.laboy@yahoo.com','INR','e41b88a5-6e12-3e13-a810-1bcc475dcb6c','2021-07-01 05:00:00',NULL,NULL),
(43,18,'Víctor Cavazos','elsa.carmona','+34 937-25-1143','gordonez@live.com','GYD','148fe23f-384c-3f65-a169-a2ee8bb023c0','1978-12-22 06:00:00',NULL,NULL),
(44,40,'Srta. Ana Isabel Juan Tercero','irizarry.aaron','950 35 4175','gcorona@yahoo.com','KPW','31563377-f2af-3326-a31c-d6edbf5bb903','1997-12-02 06:00:00',NULL,NULL),
(45,28,'Malak Delrío','silvia.montanez','938072678','pfranco@terra.com','SAR','b0a57bb5-3b32-3aee-b36e-b955c6d34b10','1981-04-06 06:00:00',NULL,NULL),
(46,6,'Silvia Bermúdez Hijo','gerard.villasenor','+34 926 01 7374','abril.pacheco@yahoo.es','IDR','07f27c83-ef6e-382a-84a6-226b3984c9be','1970-05-14 06:00:00',NULL,NULL),
(47,45,'África Merino','epons','981739640','natalia78@live.com','HRK','aad6497e-3d12-313e-b540-de5d2b8cd0ed','2006-01-24 06:00:00',NULL,NULL),
(48,45,'Amparo Rojo','nahia.figueroa','+34 909 91 1256','hsaldivar@terra.com','ETB','c762b476-fae8-385b-a73a-d3cb2190763e','1999-08-14 05:00:00',NULL,NULL),
(49,22,'Sr. Samuel Romero','yeray16','997227573','miguelangel42@terra.com','MNT','276d568a-cd3b-39af-b00d-60fdc4741525','2016-09-03 05:00:00',NULL,NULL),
(50,32,'Sonia Escobedo Segundo','fsedillo','915-436515','ldelgadillo@terra.com','BTN','eb0c6a6f-9d86-3e03-80a4-eb2a04c14865','2020-12-26 06:00:00',NULL,NULL),
(51,40,'María Carmen Soto','izan94','985 957463','guillem73@terra.com','SGD','0683f41e-9d18-33ee-956e-065819d23c75','2012-03-11 06:00:00',NULL,NULL),
(52,22,'Juan Matías','eric19','+34 973198083','montano.paula@yahoo.es','WST','3ab382c7-e650-320c-93b8-cee4bc28c390','1983-08-14 06:00:00',NULL,NULL),
(53,3,'Ariadna Arteaga','caldera.marcos','958677527','montano.mariacarmen@hispavista.com','UAH','499b586c-2dba-31e3-b373-36d3d766f2a9','1983-11-02 06:00:00',NULL,NULL),
(54,35,'Rayan Iglesias','jon17','+34 912 39 3286','hbarrientos@latinmail.com','MXN','f1202756-f843-394b-bc77-a67d9d20703d','1995-02-22 06:00:00',NULL,NULL),
(55,6,'Noa Betancourt','claudia.peralta','928 381878','marco.calero@latinmail.com','ZMW','d3c098f0-966d-318f-a7f6-2c12f53c8e2b','1971-09-07 06:00:00',NULL,NULL),
(56,16,'Olivia Segura','kcasillas','+34 971108343','andrea.valverde@hispavista.com','LRD','0bd68221-61b3-3cf7-94f0-4edf4e43f092','1992-06-17 06:00:00',NULL,NULL),
(57,1,'Luis Cuesta','gleon','+34 970041509','asier.acuna@hotmail.com','MRU','3bc87959-688e-3a96-995c-31a7183af1d5','1971-10-03 06:00:00',NULL,NULL),
(58,46,'Dr. Paula Linares Segundo','antonia.limon','945 97 1444','pabon.clara@yahoo.es','FKP','2703bfe6-9470-3551-924c-7bebed3d63b1','2014-03-01 06:00:00',NULL,NULL),
(59,4,'Biel Pacheco','laureano.mariaangeles','940-81-7295','irene.vasquez@live.com','TTD','201fd348-e8f3-3f30-b8c9-c790c68ff763','2000-07-27 05:00:00',NULL,NULL),
(60,13,'Srta. Candela Más Segundo','martin10','920-125104','roybal.raul@hotmail.es','SAR','8870c954-969f-3620-b12a-352661cc86ec','1984-08-18 06:00:00',NULL,NULL),
(61,35,'Sr. José Manuel Marrero','yaiza56','+34 926 15 1718','veronica.sierra@hispavista.com','ILS','12c088e3-85fb-3ca0-aeed-23c3d4ae90d9','2011-06-16 05:00:00',NULL,NULL),
(62,32,'Ian Hernando','cabrera.elena','978930533','enrique.olivarez@hotmail.com','ZAR','075b0263-141f-31a9-81fe-32e40f42b598','2019-08-21 05:00:00',NULL,NULL),
(63,50,'Gael Rivero','rzavala','980601939','csaavedra@yahoo.com','AED','efdafe78-54f7-3ca4-b3e3-21132ad79234','2013-03-01 06:00:00',NULL,NULL),
(64,2,'Alexia Cortez Tercero','carlos.arroyo','+34 979-60-5194','monroy.nil@terra.com','RON','b9b59209-05ca-3162-80e4-0ecc9cd2f019','2018-09-27 05:00:00',NULL,NULL),
(65,28,'Dña Elena Tamayo','zaragoza.aitana','989 81 7886','jvillanueva@hotmail.es','PYG','e5637055-6904-3c60-879a-8533bc220737','2003-04-26 05:00:00',NULL,NULL),
(66,9,'Yago Pagan','ealcala','+34 948 41 8498','urolon@hispavista.com','TMT','34c0b729-902b-34e1-9e80-eeb3502ce26e','2011-03-22 06:00:00',NULL,NULL),
(67,46,'Lidia Griego','leon.mateo','+34 903378416','hcarrion@yahoo.com','SAR','8179ea19-210a-3a64-b9c1-a79c8c8a7554','2004-03-06 06:00:00',NULL,NULL),
(68,6,'Ángela Rodríquez','nahia.arias','+34 982-847462','alma69@latinmail.com','MGA','7de1e3ce-f738-3af8-80b8-07bf646fbc60','1994-01-30 06:00:00',NULL,NULL),
(69,16,'Sr. Javier Carretero Hijo','carlota63','+34 921-64-5863','vmarquez@hispavista.com','MDL','c48b6a6b-e0fe-337e-ad00-eb733215d799','2009-01-07 06:00:00',NULL,NULL),
(70,49,'D. Nicolás Velásquez Hijo','carolina46','+34 932 65 2903','iulloa@yahoo.es','HKD','def1305b-f345-3338-8a1c-809608994c7f','2004-05-11 05:00:00',NULL,NULL),
(71,20,'Pol Guardado','lazaro.andres','954-14-5483','xloya@hotmail.com','GIP','b72d601e-0e72-3a4f-af3f-01d3ca8c14e2','2017-01-24 06:00:00',NULL,NULL),
(72,5,'Francisco Fonseca Segundo','maria36','988 42 0656','lnavarrete@yahoo.es','UZS','a0c0a088-a5d4-307c-8aa4-bbf61f711636','1970-12-03 06:00:00',NULL,NULL),
(73,31,'Verónica Izquierdo','cardona.pol','+34 989-346303','vbrito@gmail.com','BGN','c67fe8f1-0b62-32c8-b7a1-1ad4307ef094','2005-05-23 05:00:00',NULL,NULL),
(74,13,'Olga Gil Tercero','yago.valle','+34 971761938','anaya.mariaangeles@terra.com','MMK','026fea32-ec90-3b97-bd8c-dec9415ed17c','2014-10-10 05:00:00',NULL,NULL),
(75,20,'Sra. Nuria Laboy','juanjose40','958-21-4680','elemus@terra.com','BHD','631cbd91-4589-343b-a007-852f2100a648','2001-03-18 06:00:00',NULL,NULL),
(76,49,'Adrián Córdoba Segundo','eduardo.pedraza','+34 917 85 0434','mar.gonzales@hispavista.com','SHP','b1a22e1d-5ca4-3e00-ad7a-5bc18d129df3','2019-09-26 05:00:00',NULL,NULL),
(77,9,'Ing. Abril Barreto Hijo','alex.malave','+34 963 612830','juana32@yahoo.es','BDT','63dbf56d-6cf4-3bf6-984e-d64e6f2a2e58','2004-10-30 05:00:00',NULL,NULL),
(78,22,'Srta. Valeria Ayala','yperea','942-048105','puga.cesar@hispavista.com','UZS','669e0a08-f573-3fe3-9716-103e0a0e3337','1980-03-19 06:00:00',NULL,NULL),
(79,5,'Samuel Lozada','trejo.aurora','951-73-7101','nicolas.meza@terra.com','PLN','dbdc557f-c449-3c96-8832-1e5c3fc28636','1989-12-04 06:00:00',NULL,NULL),
(80,14,'José Antonio Villalpando','fernando.jimenez','912-21-4989','nuria.aguayo@hotmail.com','PHP','8c58e8bb-38f9-37c6-8883-640e57c93b0a','2020-05-14 05:00:00',NULL,NULL),
(81,14,'Gabriela Baca','gerard45','910 524097','malak.alcaraz@live.com','CVE','09f33e22-8532-396e-8a3b-79bd585d1921','2014-09-20 05:00:00',NULL,NULL),
(82,18,'Luna Alaniz','ravila','+34 949266078','rlebron@hispavista.com','SOS','ad7a38b5-f593-372f-aeed-30b02632abe1','2016-10-12 05:00:00',NULL,NULL),
(83,28,'Adam Serrano','zarate.jaime','+34 976 77 4056','kirizarry@terra.com','BBD','44906609-18a7-3c72-a13b-66f4626570af','1977-04-15 06:00:00',NULL,NULL),
(84,33,'Jaime Zambrano','firizarry','+34 961 770326','ysanz@hispavista.com','TRY','f953703a-dc94-307a-870c-d8def028bdfb','2019-09-09 05:00:00',NULL,NULL),
(85,42,'Juan Benavídez','wpolanco','+34 966-41-0958','opartida@latinmail.com','SZL','6cf7d84b-6f0e-3f11-91dd-42f4384ef395','1970-10-24 06:00:00',NULL,NULL),
(86,14,'Nil Munguía','fblazquez','+34 901 28 6624','lola.luna@hotmail.com','MXN','1d1fdb0e-ac74-3a3f-b11c-2221de993a30','1997-06-07 05:00:00',NULL,NULL),
(87,39,'Esther Gómez','arias.cristian','960112387','rayan83@gmail.com','SGD','cb21ba9e-5683-35dc-9fcc-24e4c36f0d28','1990-07-22 06:00:00',NULL,NULL),
(88,22,'Noa Andrés','anton.guillermo','984 174346','rosario.delgado@yahoo.com','CAD','15019761-bdc9-3ebd-ba55-ef66cf8ad135','1984-12-15 06:00:00',NULL,NULL),
(89,8,'Sergio Ornelas Tercero','ignacio.haro','+34 960-666714','pmojica@terra.com','STN','71f43317-62ed-3d0c-a7bb-96efcac8aca1','1986-02-20 06:00:00',NULL,NULL),
(90,27,'Aurora Guerra','mariacarmen36','922-267268','krosas@yahoo.com','SBD','72494ece-223d-3530-a677-7350995455c2','1985-07-04 06:00:00',NULL,NULL),
(91,6,'Dr. Pedro Manzanares Hijo','pmadrigal','+34 925306764','malak.calderon@terra.com','CVE','5dce23d6-0306-3ddf-8585-1fd8ab080b2b','1996-11-28 06:00:00',NULL,NULL),
(92,29,'Andrea Menéndez','wmontano','+34 936925401','martin.sarabia@yahoo.es','AMD','7df47d75-388a-3655-be2a-ffb590c0929c','1970-10-30 06:00:00',NULL,NULL),
(93,30,'Oriol Muro Segundo','jmartos','974-62-5493','qjaquez@hotmail.es','MWK','8934eb6d-1208-38e9-9249-cace59947500','2020-09-27 05:00:00',NULL,NULL),
(94,9,'Dr. Nicolás Villalba','mireia.padilla','+34 988-635052','yesteban@hotmail.es','MYR','3f058ccc-e025-3a96-a3e8-935c917fa908','1979-06-19 06:00:00',NULL,NULL),
(95,27,'Dr. José Merino','xvillanueva','+34 945 65 5985','jan74@gmail.com','IRR','fb40670d-5049-342d-bdd5-3360c57fdc23','1997-02-09 06:00:00',NULL,NULL),
(96,31,'Asier Carrera','yaiza.narvaez','+34 907 782995','fernandez.unai@hotmail.es','GTQ','91537272-d831-313e-b11d-762eeddf9ef1','2009-08-29 05:00:00',NULL,NULL),
(97,10,'Úrsula Millán','pblasco','931 704036','alonso.sanchez@latinmail.com','BIF','8d3c2cef-9ee7-3d6e-9d1d-17574e4c859e','1994-10-09 06:00:00',NULL,NULL),
(98,11,'Lic. Alejandra Altamirano','jose.sosa','+34 959695172','ysanz@hotmail.com','TWD','917200f9-ec3e-3a2b-85c6-66547d75c282','1976-01-11 06:00:00',NULL,NULL),
(99,40,'Pilar Cantú Tercero','rodriguez.saul','911-36-2731','lorena.quintana@gmail.com','PEN','ef33ae7c-fd2f-3ae3-8357-0207dfd98b49','1984-03-15 06:00:00',NULL,NULL),
(100,22,'Víctor Canales','rpineiro','985984504','lheredia@hispavista.com','USD','41dfe90c-8dfb-3e99-85ff-913a1f45cfaa','1988-01-03 06:00:00',NULL,NULL),
(101,26,'Antonio Cabello','obarraza','904 28 9381','malak.velasquez@gmail.com','RON','f664e1e9-ca99-35d2-90a4-c6e2e69edb8f','2014-11-07 06:00:00',NULL,NULL),
(102,20,'Jaime Chávez Segundo','mdelao','920-660198','santiago36@hotmail.es','PHP','afab3b46-edd3-351b-a785-814a9b55a0e4','2003-09-09 05:00:00',NULL,NULL),
(103,20,'Francisco Javier Enríquez','oizquierdo','943-399548','teresa.mondragon@hotmail.com','PHP','5140e99a-184b-313b-a732-81fac3a08ffb','2022-06-01 05:00:00',NULL,NULL),
(104,34,'Dr. Jaime Quintanilla','lnunez','908-59-1812','yaiza06@yahoo.es','KZT','7fe86506-c596-3df7-acd1-95a1d48fd4ad','1988-11-10 06:00:00',NULL,NULL),
(105,17,'Natalia Marroquín','qvasquez','995-43-4701','oasensio@hispavista.com','SHP','4941339b-d98c-36cc-b98a-7d12cb858f9c','1985-06-27 06:00:00',NULL,NULL),
(106,6,'Alma Ozuna','qteran','998 72 7726','leo.garica@yahoo.es','BBD','8e739f91-4eca-3039-81ee-92aab56d30b9','1983-04-28 06:00:00',NULL,NULL),
(107,41,'José Antonio Aguirre','valles.jan','941-959788','pilar.magana@hotmail.es','THB','a4252c26-f995-3c4e-b2ee-dab388442f9c','2000-10-12 05:00:00',NULL,NULL),
(108,11,'Adrián Cano','meza.nerea','994 73 3027','carlota56@yahoo.com','ILS','d7116f1a-0dbe-36bf-8ee0-b36502013afc','1975-11-20 06:00:00',NULL,NULL),
(109,7,'Lic. Ariadna Calero','eibarra','952-063728','karanda@gmail.com','MXN','e1e7f43a-0c4d-36d0-b819-498e64f442cd','2012-09-24 05:00:00',NULL,NULL),
(110,36,'Rosa María Cotto','mmarco','931-125654','celia06@terra.com','TJS','d63fd6e0-b47f-31c4-95a6-6114d9df1a38','1975-11-30 06:00:00',NULL,NULL),
(111,44,'Óscar Domínquez','olga.orta','901 71 9641','elena78@yahoo.com','BBD','f2c1c82d-f874-3684-8ddc-51c99b0907d1','1992-10-09 06:00:00',NULL,NULL),
(112,12,'Pedro Rosario Segundo','mjaimes','+34 979 438210','bmagana@hispavista.com','MDL','020f3df1-3cde-3a95-8cae-f16c322b7b50','1970-06-08 06:00:00',NULL,NULL),
(113,19,'Luis Ojeda Tercero','mateo47','995 663960','maria87@gmail.com','MVR','8fa9b0d3-d9c5-3f47-afdd-e581ad5adece','2016-02-23 06:00:00',NULL,NULL),
(114,39,'Valentina Benavides','izan.gutierrez','+34 920655707','celia.lorenzo@hotmail.es','XCD','8c819b8e-8e45-36c0-8b4d-96692fb25111','2015-07-13 05:00:00',NULL,NULL),
(115,37,'Marc Atencio','osoriano','987884287','alejandro.isaac@yahoo.es','MKD','db66597e-bcb5-3e04-b90f-3ca7c4215005','2018-08-06 05:00:00',NULL,NULL),
(116,32,'Guillermo Mateos','ysantamaria','+34 967 360566','lprieto@gmail.com','TRY','4a726561-d2cf-335d-8d6a-469b2ff92723','1989-02-03 06:00:00',NULL,NULL),
(117,22,'Dr. Diego Casares','antonio.galvez','+34 987-91-6688','rosario.lucio@hotmail.com','KHR','540ca773-c4bf-351f-b940-00929ecc80d1','1998-10-21 05:00:00',NULL,NULL),
(118,8,'Lic. Guillermo Adorno','pcardona','939 95 4184','cvergara@hotmail.es','KYD','5f14125e-afb0-3d95-9a4f-1d825366263c','1977-01-24 06:00:00',NULL,NULL),
(119,18,'Manuel Aguado','ddiez','925-654502','hurtado.carmen@hotmail.es','LAK','1c2c7643-79eb-30f0-9678-08ccb8b4abf3','1999-08-07 05:00:00',NULL,NULL),
(120,13,'Dña Lidia Canales Hijo','navarrete.mario','+34 909 90 2987','ursula.abreu@hispavista.com','DZD','b1cb1343-c5e1-3fad-beb5-7b65f9c02369','1985-08-01 06:00:00',NULL,NULL),
(121,21,'Carmen Valdez','enrique.prieto','934-89-1212','earce@hotmail.com','SCR','d1276239-ac3e-3072-871e-675f2fc858d8','2015-06-13 05:00:00',NULL,NULL),
(122,38,'Ing. Zoe Guajardo Tercero','franciscojavier31','+34 939-354363','cgallego@yahoo.com','TWD','ca48d706-a036-37a6-b044-cd70f05b5dcf','2001-04-24 06:00:00',NULL,NULL),
(123,2,'Víctor Andrés','jon.ochoa','+34 969-685279','zfonseca@yahoo.com','HTG','dc1ce5f2-7007-3bdd-9e83-5f51af5f994f','1981-12-20 06:00:00',NULL,NULL),
(124,25,'Sra. Silvia Pons Hijo','dominquez.unai','+34 928258062','dejesus.helena@hispavista.com','HNL','525369d6-0be7-3bbd-8550-edda74be1175','2013-04-06 06:00:00',NULL,NULL),
(125,34,'Oliver Corral','nahia.blanco','961 11 3595','francisco.hernandez@latinmail.com','MNT','6e6757fb-4240-3078-a64c-22af806ed121','1976-03-29 06:00:00',NULL,NULL),
(126,45,'Carlos Gallardo','lola.concepcion','+34 906-47-3417','berta.hernandez@yahoo.es','PEN','37197e0e-5ea6-3f22-b588-a4fb2e206cc7','2012-12-06 06:00:00',NULL,NULL),
(127,46,'Antonio Briones','antonia36','989-33-8328','aurora52@hotmail.com','HRK','ad5a1d47-5c20-343e-a6a8-fc71a29a0baf','1973-04-30 06:00:00',NULL,NULL),
(128,50,'Encarnación Sepúlveda','gabriel.cedillo','+34 943 36 7461','david24@hotmail.com','RUB','eb468d02-e6ed-32b9-82fa-8a5bb1eef79c','2000-06-02 05:00:00',NULL,NULL),
(129,7,'Pilar Segura Tercero','fuentes.rodrigo','+34 981490258','aapodaca@latinmail.com','HUF','8a626fbb-96a3-3cd3-84d1-dffca5dddd7f','1970-03-27 06:00:00',NULL,NULL),
(130,15,'Alexia Hidalgo','miguel.marina','+34 932-506373','olivo.rosamaria@terra.com','AZN','ff8889df-4d0b-3988-8bfc-e44fb9d3d89f','1999-04-17 05:00:00',NULL,NULL),
(131,5,'Ana Isabel Collado Hijo','leo.serrano','973-70-8323','zaguilera@yahoo.es','BND','8c6af197-f363-3941-a34f-542d5a2148ac','2019-07-28 05:00:00',NULL,NULL),
(132,30,'María Pilar Verduzco Hijo','hector84','996-94-4752','raquel.chacon@terra.com','AED','17e73d4d-80ab-34da-9cdf-145fe82106c7','2005-11-23 06:00:00',NULL,NULL),
(133,50,'Jesús Tirado','sroig','+34 982 63 8983','palomo.lara@terra.com','BMD','07e29def-730b-3caf-931b-20899f183f28','2021-11-24 06:00:00',NULL,NULL),
(134,20,'Ángel Nájera Segundo','pedro.casas','972-37-0529','jiminez.anaisabel@hotmail.com','SOS','c0e1c840-0a2b-31d3-8a11-177cc30fc405','1995-07-25 06:00:00',NULL,NULL),
(135,1,'Abril Pizarro','lola.hernadez','+34 986-36-5718','irene18@terra.com','SGD','1254adab-4f5b-3546-b665-ce0f9de72ad6','2012-05-17 05:00:00',NULL,NULL),
(136,25,'Ismael Guerrero','franciscojavier48','910 123269','tovar.luna@hotmail.com','PYG','002a4bda-8153-352f-b8c3-b4a3ce94a88b','1986-09-09 06:00:00',NULL,NULL),
(137,45,'María Carmen Sola','rosamaria.garrido','+34 942 89 3625','nrivas@terra.com','PAB','262e069e-471e-3db0-8d60-cf86613d1a4a','2014-04-18 05:00:00',NULL,NULL),
(138,7,'Antonio Carmona','macosta','+34 922130713','paponte@live.com','STN','87b1cac9-e0c7-3bfa-a576-ba90de209159','1990-08-17 06:00:00',NULL,NULL),
(139,27,'Rosario Sánchez Hijo','deleon.sara','+34 985-059656','alejandra.santamaria@latinmail.com','BIF','a93fba81-087e-3c23-b41b-cdba8aefbaed','1995-10-25 06:00:00',NULL,NULL),
(140,22,'Lic. Ian Tijerina Segundo','noelia78','917-09-3237','ivan.hidalgo@hispavista.com','BIF','bcf460ce-edc8-335c-bf49-6415f83623a4','1982-12-18 06:00:00',NULL,NULL),
(141,13,'Oriol Galindo','carreon.andres','977 513129','andres.moya@hotmail.com','ZMW','4717c0d7-4389-3a12-a5b5-63858ef74f9f','1999-11-25 06:00:00',NULL,NULL),
(142,2,'Rubén Villegas','urodriquez','940-88-1835','rosamaria95@hotmail.com','SSP','f2c75809-d1da-372d-98f9-dbe5afe39607','2003-05-05 05:00:00',NULL,NULL),
(143,10,'Lic. Nuria Posada Tercero','bcrespo','+34 989227305','linares.joel@terra.com','RON','76b625cb-5371-390e-b53a-dd53362a2dc0','1973-12-02 06:00:00',NULL,NULL),
(144,20,'Carlota Carreón','acuna.saul','+34 954-877492','juanjose.delarosa@hispavista.com','THB','97c9bb77-03ae-3618-81d0-39d2974a027f','1971-09-12 06:00:00',NULL,NULL),
(145,10,'María Cabrera','padilla.angela','+34 916 16 9203','roque.olga@terra.com','MWK','5fe24441-c419-3a4e-be39-b034420a4ec2','1972-04-22 06:00:00',NULL,NULL),
(146,16,'Gael Cervantes','laia29','+34 927 780849','gael81@yahoo.com','KES','eeeee316-bdc7-3a87-b287-114df4e02711','2013-11-23 06:00:00',NULL,NULL),
(147,35,'Mar Almonte','claudia.galvan','968 74 6488','crespo.rosamaria@yahoo.es','BTN','c83290d7-99db-3ba8-974b-d3b3c2fc40f4','1982-06-10 06:00:00',NULL,NULL),
(148,23,'Ing. Aina Román','veronica.espino','970-37-0391','juanjose44@hotmail.com','ISK','45c76172-5f7b-34df-bf21-40862a3139dc','2005-01-09 06:00:00',NULL,NULL),
(149,23,'Dña Noelia Nava','suarez.franciscojavier','+34 945-863627','paola99@hispavista.com','JMD','9a387d73-c1bf-3cd9-beb8-82dad846fa46','1975-06-03 06:00:00',NULL,NULL),
(150,13,'Gabriela Ocasio','ijasso','+34 946-319688','rvaldivia@latinmail.com','YER','996b4210-dfa8-378f-b868-35a4430b63b1','2004-03-27 06:00:00',NULL,NULL),
(151,9,'Gael Domínquez Tercero','dcisneros','981 660814','amares@hotmail.es','IDR','87356f68-1c29-361f-b11d-eb96c8f92245','2015-04-01 06:00:00',NULL,NULL),
(152,35,'Dr. Aleix Delgadillo','jsoto','+34 911679637','vaca.abril@yahoo.com','FJD','c6408cc1-4ae9-397e-9a22-87a502a48a75','2011-08-14 05:00:00',NULL,NULL),
(153,1,'Adrián Rendón','guillermo16','949-435667','yeray.badillo@hotmail.com','AOA','39334158-30b6-3403-8e99-208dd6d5304a','1974-07-25 06:00:00',NULL,NULL),
(154,40,'Nerea Lorenzo','moquendo','904 74 2200','moreno.isaac@gmail.com','NIO','b3b5d01f-f7d9-309e-863e-01866706980f','2022-05-30 05:00:00',NULL,NULL),
(155,3,'Ángela Partida','velazquez.paola','976 21 8161','jose71@hotmail.es','TOP','a7df5df8-29bf-30b9-b46a-438d57a4f4de','2014-12-04 06:00:00',NULL,NULL),
(156,10,'Mario Olvera','adriana.valdes','+34 993-386147','antonia81@hotmail.com','MZN','1ed04753-4053-3ec1-9e7e-05ff4adaec4b','1983-04-10 06:00:00',NULL,NULL),
(157,48,'Sr. Carlos Zarate Segundo','espinal.yeray','976764411','cordova.amparo@hispavista.com','PLN','f1268f2c-6d81-3fb2-ba89-5d087468dc81','1998-12-30 06:00:00',NULL,NULL),
(158,34,'Joel Galindo','nadia68','+34 984 306858','oriol.cuevas@live.com','GMD','79056a78-f5ef-34c2-a22d-306f72e6ccbf','2003-09-25 05:00:00',NULL,NULL),
(159,25,'Ing. Adrián Valverde Segundo','ecarranza','+34 964-55-3397','bermejo.carmen@hotmail.com','LSL','76ee3eba-67dd-3bb1-9719-4f22d90c11e5','1972-08-30 06:00:00',NULL,NULL),
(160,2,'Ainhoa Briones','ander28','+34 926-809786','hplaza@yahoo.es','PKR','de506a78-378d-3de0-9bb9-6f928a3b4711','1991-02-25 06:00:00',NULL,NULL),
(161,14,'Sr. Marcos Delvalle','carlos29','+34 929-354358','manuela.alonso@live.com','IDR','ec010d80-395b-3c44-b55a-472f944fdc3c','2003-05-15 05:00:00',NULL,NULL),
(162,39,'Laia Cuevas','cedillo.blanca','+34 911209149','diana78@terra.com','CAD','97618239-66fa-320b-a23e-ac3d9e72f517','1995-11-12 06:00:00',NULL,NULL),
(163,42,'Sra. Ona Delapaz Segundo','godinez.oliver','915 06 4106','zmora@latinmail.com','OMR','c01d79ce-acfe-3fa8-8d12-558c80641d20','2013-08-16 05:00:00',NULL,NULL),
(164,19,'Abril Valadez','patricia.mojica','961 578434','berta98@yahoo.com','XAF','2107f3db-af31-3cc3-8b58-999bbe1dcd09','2018-05-05 05:00:00',NULL,NULL),
(165,29,'Sr. Pablo Carvajal Hijo','guillermo.rincon','+34 972-902702','adorno.sandra@hotmail.com','BRL','2f8c7f02-b4bb-3843-b97b-d78a5c11e138','1980-07-16 06:00:00',NULL,NULL),
(166,10,'Alexandra Almaráz','martin.miguel','+34 992255443','griojas@hotmail.es','HRK','214a47ee-db64-3469-9c5f-40f73d79f82f','2003-05-29 05:00:00',NULL,NULL),
(167,3,'Alexia Villanueva','mara15','936398111','cerda.victoria@terra.com','BYN','9578fb2a-df2c-3047-9e43-242fb42aef41','2006-08-19 05:00:00',NULL,NULL),
(168,23,'Nil Morales','mariapilar.ruiz','928625002','cbaez@live.com','SDG','5834858c-86ca-3118-b373-a50497878786','1984-10-30 06:00:00',NULL,NULL),
(169,14,'Noelia Pichardo','carrera.rocio','941 798958','cfont@yahoo.es','DKK','37624fed-693a-34c4-9f66-63849edd69d7','2005-05-07 05:00:00',NULL,NULL),
(170,16,'Margarita Zavala','ocamacho','991-082169','alexandra00@yahoo.es','NPR','6000c6a3-fe51-381b-a2c7-80a698750d74','2014-02-10 06:00:00',NULL,NULL),
(171,42,'Dr. Rayan Cuenca Hijo','jose.altamirano','965 503866','bmata@gmail.com','KZT','8f88d15e-82ed-3f1d-9304-81d3add0f819','2006-07-18 05:00:00',NULL,NULL),
(172,12,'Javier Ornelas','quezada.veronica','+34 963332568','nora.carranza@yahoo.com','NOK','06c8e76f-91b1-3a98-bd9b-d86dc610f8f4','2020-12-12 06:00:00',NULL,NULL),
(173,39,'Hugo Bravo','zluevano','+34 982-942167','hugo.flores@live.com','AZN','dc1cee26-8e45-3305-a1e2-b8318dfdb752','1993-12-22 06:00:00',NULL,NULL),
(174,30,'Sr. Marcos Aguilar Segundo','cisneros.alicia','913038240','fernando43@gmail.com','CLP','c1623891-9e38-3778-b229-fe73aa4df691','2006-01-22 06:00:00',NULL,NULL),
(175,42,'Marcos Solorio','alexia.frias','924-657345','nayara.abeyta@yahoo.es','WST','c00df60b-5902-36e4-9e28-101f76a33702','1988-01-02 06:00:00',NULL,NULL),
(176,36,'Lic. Isabel Pagan','calero.marta','964 00 3594','delagarza.patricia@hotmail.com','HRK','b78c70f7-f426-3318-b921-6ceb5aa61432','2000-02-14 06:00:00',NULL,NULL),
(177,32,'Dario Más Tercero','alvaro21','+34 982-46-4469','nayara.andreu@yahoo.com','CLP','288f0ec7-2a6a-32ad-8ead-5239001b3647','1978-04-03 06:00:00',NULL,NULL),
(178,17,'Naiara Salgado','marta.haro','901 08 6812','marrero.franciscojavier@live.com','CAD','8fc028e4-7131-3c85-8277-780a9625b273','1999-03-08 06:00:00',NULL,NULL),
(179,13,'Lidia Verdugo','ycaro','+34 953-02-5758','irene.zayas@latinmail.com','MXN','77175005-d188-359c-9b9f-3c89139ca5e6','2007-10-15 05:00:00',NULL,NULL),
(180,11,'Lic. Paola Aragón Tercero','ariadna.tirado','951-922887','guardado.angel@hispavista.com','SGD','28ad5169-49b7-3001-8a15-8801bef9cf40','1990-11-25 06:00:00',NULL,NULL),
(181,20,'Mateo Salas','miguelangel21','992808354','soria.irene@terra.com','BDT','62b992b6-611d-3439-9fc9-9f1eefe13a73','1990-06-27 06:00:00',NULL,NULL),
(182,42,'Nahia Delacrúz','fapodaca','929 224084','pau.velez@live.com','ZAR','5d85ae3f-0fe6-360a-b22c-11f0939f02cd','1975-08-01 06:00:00',NULL,NULL),
(183,8,'Ing. Pablo Valle','esther43','940 40 2841','antonio48@hotmail.es','SLL','1454660b-1cc9-3075-8f80-202160fb4f07','2014-12-28 06:00:00',NULL,NULL),
(184,30,'Inmaculada Leyva','jrosario','+34 936 304684','abrego.amparo@latinmail.com','BGN','fe6053df-ab9e-3dd0-854e-f309e4f1c1d4','2006-01-01 06:00:00',NULL,NULL),
(185,7,'Sra. Pilar Gaytán','castellanos.amparo','945814901','icordero@live.com','BDT','8a943d4a-bb6a-3e6c-949e-875d67c8219a','1979-11-29 06:00:00',NULL,NULL),
(186,44,'Ing. Óscar Lovato','naia96','914-50-9485','aaguilera@yahoo.com','DOP','651bbc56-8fbb-33f2-89bd-75fb47d0abd8','2011-06-18 05:00:00',NULL,NULL),
(187,18,'Eduardo Caballero','hugo.riojas','939-110934','cristian95@hispavista.com','SLL','e2b0fed4-aaa1-3b98-a2f1-ef1815107a7b','1997-12-23 06:00:00',NULL,NULL),
(188,13,'Lara Soliz','gloria.aguirre','+34 946 01 3636','guillermo.tapia@gmail.com','XOF','e5acefe0-793f-3ba3-9606-d82aebc33e16','1975-02-02 06:00:00',NULL,NULL),
(189,20,'Javier Verduzco','zmoreno','952-332858','almaraz.joseantonio@terra.com','TTD','23015845-7896-3f2f-ae20-27d52a771d85','1991-11-25 06:00:00',NULL,NULL),
(190,16,'Diego Quintero','nicolas23','919-735924','tmadrid@hotmail.com','CNY','f45a0481-42a0-3a29-a27d-85ccd81e0863','1983-07-06 06:00:00',NULL,NULL),
(191,36,'Alex Guerra','malva','+34 931 86 1400','sergio.ibarra@yahoo.es','CUC','d6009420-0161-3b47-a94f-fff172a9d3d5','1985-11-29 06:00:00',NULL,NULL),
(192,11,'Ing. Rodrigo Núñez','nbermudez','+34 972-79-1542','lucas40@hispavista.com','AMD','d367d4d4-c7b1-3c05-8ea9-53c851181f30','1973-03-04 06:00:00',NULL,NULL),
(193,19,'Antonia Meraz','cazares.daniel','+34 964 09 0043','aguilera.aaron@live.com','CAD','9d0e0849-ffa1-340b-9fa1-c12bcd288dc2','2015-07-22 05:00:00',NULL,NULL),
(194,23,'César Carmona Tercero','canales.pol','+34 900 515737','lpedroza@live.com','PLN','ad35edb5-c47e-3694-84b0-95aae5862ad4','1994-12-26 06:00:00',NULL,NULL),
(195,20,'Ing. Gabriel Gaitán Segundo','zelaya.cristian','958-372559','antonio11@yahoo.com','AWG','aba2e891-a176-3299-9a23-c0aa7098255f','2006-06-17 05:00:00',NULL,NULL),
(196,32,'Daniel Sauceda','asensio.samuel','919-94-8474','ybarra.yaiza@hotmail.com','XCD','7850ae31-0d05-3c4c-b42f-e9a5421af537','2020-01-12 06:00:00',NULL,NULL),
(197,8,'Oriol Salcedo','nora01','+34 906963779','herrero.raquel@terra.com','INR','c71ac0b4-6ccb-3d62-a177-9ae0f5c1812d','2018-04-24 05:00:00',NULL,NULL),
(198,33,'Jon Ávila','yolanda87','940-632635','gamboa.asier@yahoo.es','BMD','d5a68739-d397-396d-9820-5df7b22c436f','2020-08-08 05:00:00',NULL,NULL),
(199,11,'Miguel Tijerina','franciscojavier01','+34 995406774','silvia.gutierrez@hotmail.com','IRR','7fbe3b00-1cfe-3778-b8a6-81bfffdad501','2013-09-12 05:00:00',NULL,NULL),
(200,37,'Ing. Dario Mireles','adam08','+34 923 41 9050','clara.mendoza@hotmail.com','KYD','be7933bf-8443-35f1-ad0f-ec8c71f0a03f','1991-06-07 06:00:00',NULL,NULL),
(201,12,'Carlos Lucio','jaime64','901329894','adriana77@yahoo.es','EGP','f58d6767-147f-3eb2-83d4-d9a7d7c6755c','1993-10-05 06:00:00',NULL,NULL),
(202,3,'Ing. Nuria Solano Segundo','biel92','+34 968-092928','carlos58@terra.com','HTG','b38c85b5-e850-35f8-adca-8f3f206e0c26','1980-08-19 06:00:00',NULL,NULL),
(203,38,'Rosa Montoya','gvalenzuela','956-73-7884','alvaro49@hispavista.com','UAH','0bd355ca-1315-33a0-a45e-3c9f82b36d08','2000-12-24 06:00:00',NULL,NULL),
(204,46,'Ing. Ana Flórez Tercero','ramirez.jorge','996972051','armas.nuria@hispavista.com','TMT','bab8566c-2533-3b1e-836f-d9021b9f09da','2007-09-09 05:00:00',NULL,NULL),
(205,7,'Inés Negrón','tgalvan','+34 914-964950','sleyva@hotmail.com','RUB','f77ccf75-eb2f-3150-8e86-24e9ba2b5ea4','2004-05-18 05:00:00',NULL,NULL),
(206,29,'Alberto Agosto','santamaria.blanca','988-67-6430','aina43@live.com','VUV','016b909d-f4aa-37c6-a411-aa8b948fe21f','1991-01-19 06:00:00',NULL,NULL),
(207,30,'Noa Cavazos','aurora18','+34 990-07-5312','francisco72@yahoo.es','IDR','f8cf277a-569c-3273-837e-eb7497b5785e','2006-10-07 05:00:00',NULL,NULL),
(208,31,'Luis Sierra','juana41','910 067167','maldonado.ian@terra.com','FJD','6d646a4b-9635-3594-b65b-2e6becd2049d','1999-06-25 05:00:00',NULL,NULL),
(209,32,'Ona Luevano Tercero','resendez.leo','914532862','ihernandez@hotmail.com','CLP','543f16e5-f6c7-345b-b057-6afe4132355a','1987-01-13 06:00:00',NULL,NULL),
(210,8,'Lic. Jordi Caldera','hgomez','954 173229','zdomingo@terra.com','KZT','6036197b-d873-36f1-b947-a127d5c8b7c4','1975-02-16 06:00:00',NULL,NULL),
(211,50,'Martina Arellano','olinares','+34 984-18-8228','cantu.ian@hotmail.es','CUC','6cf7cf2f-89d3-3c19-8e44-5869705b10b6','2009-02-17 06:00:00',NULL,NULL),
(212,22,'Ana María Estévez','mariacarmen.miramontes','900 883344','vmanzano@yahoo.es','TRY','fe919af0-64ec-30ba-a7d0-07bf183364e0','1984-03-11 06:00:00',NULL,NULL),
(213,12,'Rosa Tafoya Segundo','vroig','949-147412','rmontenegro@gmail.com','ALL','788d8d79-400e-3f80-b3c8-636ad5fd0351','1987-07-28 06:00:00',NULL,NULL),
(214,24,'Isaac Sotelo','morales.nicolas','977 811243','julia.lucio@hispavista.com','DJF','130c9a45-c57a-34ba-8391-ddc695bebda6','2016-01-03 06:00:00',NULL,NULL),
(215,3,'Dr. Fernando Quiroz Tercero','eestevez','939791300','diego87@hotmail.com','KYD','127e55d3-5530-37e1-b974-2b896cbb85a8','1982-03-28 06:00:00',NULL,NULL),
(216,11,'África Esparza','velez.irene','952-521151','alvaro.arias@hotmail.com','MNT','7f913545-5593-33a4-a98d-dbf834d9fa7f','1973-09-23 06:00:00',NULL,NULL),
(217,13,'Olivia Meraz','heredia.sandra','974 556219','francisco.solis@hotmail.com','VES','f62f7c17-7ac0-3e76-9cf1-e2a81c1f3c40','1986-08-12 06:00:00',NULL,NULL),
(218,30,'Valeria Puga','rolon.rosario','+34 936-888130','ian.nava@yahoo.es','BYN','8375a01a-56e9-3ac9-82c0-e20b67990dab','2006-10-02 05:00:00',NULL,NULL),
(219,6,'Naia Reina','franciscojavier.crespo','985-09-9752','lzapata@terra.com','HNL','683b5ea6-18bf-3d4c-8d13-e52e460ae532','2007-04-29 05:00:00',NULL,NULL),
(220,4,'D. David Patiño Tercero','alicia67','+34 953 041622','leire.prado@hotmail.es','LBP','a83e38fa-04bb-3e65-bbed-fc670805e081','1979-04-22 06:00:00',NULL,NULL),
(221,31,'Andrés Calderón Hijo','ehurtado','915-714100','rojas.angel@hotmail.com','CUC','7c332abc-1773-36ed-91a2-b9aa75f0a6ce','2006-05-31 05:00:00',NULL,NULL),
(222,44,'Marta Villalba','patricia.menchaca','908-673350','meza.elsa@hispavista.com','PLN','5981ac5e-0f13-3874-8424-dc0d43e53a5e','2020-01-06 06:00:00',NULL,NULL),
(223,21,'Manuel Sandoval','lola68','+34 923-321098','yago.moral@yahoo.es','GHS','cf494a5c-0b50-3a43-b1c7-948dbb11eb42','2020-11-18 06:00:00',NULL,NULL),
(224,49,'Salma Casillas','juan.rayan','932876224','gurule.alvaro@yahoo.es','UGX','ac0f73bb-393a-3466-85be-fc4753c491a6','1983-04-27 06:00:00',NULL,NULL),
(225,38,'David Terán','valeria54','958-998917','luribe@yahoo.es','OMR','ab11698c-52b7-3f20-bf2f-70dcf9a9f7f1','2000-11-14 06:00:00',NULL,NULL),
(226,25,'Cristina Nájera','martin99','999-10-0364','pol28@live.com','KZT','5664ba5c-b93b-306c-810a-e2bbfa458efa','2000-08-19 05:00:00',NULL,NULL),
(227,21,'Valentina Sanabria','armijo.raul','983 969413','santana.carlos@yahoo.es','HKD','ada05143-84f4-3c3d-a029-cd67a58699c5','1982-03-10 06:00:00',NULL,NULL),
(228,13,'Alejandro Vergara','ivan38','939 900348','carmona.javier@hotmail.com','CZK','e1e1232d-3886-3536-a1cd-d4f7686d5e92','1977-10-10 06:00:00',NULL,NULL),
(229,49,'Javier Arellano','montemayor.jordi','915-297463','jaime34@gmail.com','UGX','ab456259-c307-320f-bd95-47caba62022f','1978-03-04 06:00:00',NULL,NULL),
(230,43,'Sra. Alicia Gallardo','gaitan.esther','929-576532','acollado@gmail.com','PGK','a141ade4-5549-3d61-a7b7-fd39451f81d0','1993-10-24 06:00:00',NULL,NULL),
(231,28,'Dr. Oriol Valladares','miguelangel.covarrubias','+34 985 67 3452','uochoa@gmail.com','MDL','040961e0-38be-3a57-96a7-9b2c636ff73c','1972-11-14 06:00:00',NULL,NULL),
(232,17,'Srta. Rosa María Córdoba','salma97','920-258138','lola.miramontes@hispavista.com','GIP','fe5621e2-47a0-3559-bc4b-4a2fe566aad5','1990-03-28 06:00:00',NULL,NULL),
(233,45,'Andrea Tamez','pau.raya','940-76-8073','jvalladares@yahoo.es','STN','6fafd713-e757-3a16-9aeb-e1458a36eb1c','2012-10-08 05:00:00',NULL,NULL),
(234,32,'Adrián Pelayo','rodarte.gonzalo','+34 953594027','gabriel63@live.com','XPF','a0f12c18-684e-3a79-9e73-4ffce156216a','1972-11-27 06:00:00',NULL,NULL),
(235,41,'Esther Cabello','berta49','+34 933-66-5355','miguelangel.villalobos@yahoo.es','TRY','0332783b-17f6-3d7b-a874-fcae7e6e49a4','1986-04-18 06:00:00',NULL,NULL),
(236,13,'Sr. Asier Esquibel Hijo','helena47','+34 989835104','mas.manuel@yahoo.com','KMF','bd306ccf-bc56-398d-9ceb-f68cb37931a7','1983-03-07 06:00:00',NULL,NULL),
(237,34,'Dr. Adrián Narváez Hijo','ainara.olivera','979 47 4573','alex.abeyta@hotmail.es','BTN','4b875007-ad43-3cf4-9c4c-23bc72f6da64','1999-09-02 05:00:00',NULL,NULL),
(238,27,'José Manuel Martín','heredia.alonso','972 85 6928','qbenavides@yahoo.com','BZD','3fcb12d8-7f8f-389a-8441-a03b5dbbee1d','2012-11-26 06:00:00',NULL,NULL),
(239,33,'Dr. Javier Gallegos','concepcion.hugo','+34 927 102251','biel68@latinmail.com','NGN','0028ff5d-2ff1-3e79-a40d-455f55aaf171','1978-02-08 06:00:00',NULL,NULL),
(240,14,'Aurora Delvalle','perales.ruben','964-93-0305','tamayo.anamaria@yahoo.es','GNF','d2fb5166-d4f3-3682-9762-96e712403077','1983-01-12 06:00:00',NULL,NULL),
(241,12,'Naia Anguiano','resendez.juana','+34 905313569','vera50@hispavista.com','SLL','058bc8b9-7aac-3631-b2f0-905acdd59f62','2012-11-09 06:00:00',NULL,NULL),
(242,20,'Patricia Alvarado','nava.erik','950516638','francisco.gimeno@live.com','ANG','43a35964-b743-3dbc-8cad-249dbdf41b30','2004-06-05 05:00:00',NULL,NULL),
(243,19,'Alonso Soriano','gimenez.carmen','924895862','sarabia.jorge@live.com','JPY','55620356-7d53-3c9f-ad24-23f3c6a026f7','1972-11-23 06:00:00',NULL,NULL),
(244,45,'Srta. Ona Maldonado','aaleman','+34 971750190','nayara.arriaga@gmail.com','DOP','a1e78f6f-be1e-3609-a11b-19b0794a89a3','1971-09-28 06:00:00',NULL,NULL),
(245,45,'Inmaculada Montez','yvillalpando','+34 939 348445','arnau54@yahoo.es','MRU','72420485-923d-3227-9d62-aee6408368ff','1974-08-17 06:00:00',NULL,NULL),
(246,43,'Sandra Tejada','qledesma','+34 954040726','anguiano.rosa@gmail.com','KRW','6a8fbc35-95d7-3cf0-abe7-1db1cab81246','2009-12-01 06:00:00',NULL,NULL),
(247,37,'Santiago Rendón Hijo','erik92','972 08 9627','elsa48@live.com','KMF','c33a657a-a819-3968-8ed4-73c5735577a9','2000-12-01 06:00:00',NULL,NULL),
(248,25,'Alex Quintana','palomo.antonia','+34 915-260738','casares.miriam@yahoo.com','TWD','0e1ff978-59ae-35a9-bff1-8dbe9287131d','2000-07-17 05:00:00',NULL,NULL),
(249,38,'D. Dario Flores','alicia.esteve','+34 983-124038','kestevez@live.com','THB','4aecf414-0ce5-34ac-b7cf-6bd4abc759e2','1984-11-15 06:00:00',NULL,NULL),
(250,46,'Patricia Villar','imenchaca','950 28 4948','jaimes.lara@terra.com','ARS','bc0aba5a-d97c-3ae0-a179-7c6c82a3c4ce','1977-07-06 06:00:00',NULL,NULL),
(251,23,'Lic. Manuel Alvarado Hijo','iker81','993-30-0740','asier13@gmail.com','KGS','db1e7708-c182-311a-a32d-922eeb331f8f','1987-03-31 06:00:00',NULL,NULL),
(252,18,'D. Enrique Henríquez','wreynoso','961 116141','alva.irene@terra.com','VES','7b990701-2dcd-3f1a-99ea-c236d2cf4531','1994-09-15 06:00:00',NULL,NULL),
(253,34,'Lic. Aina Paredes Hijo','carevalo','988-218793','quintana.diana@hispavista.com','SRD','6a42172d-dd50-39a4-be2f-a78ca73f2283','1990-04-02 06:00:00',NULL,NULL),
(254,48,'Dr. Biel Izquierdo','isabel93','+34 957259883','adelatorre@hispavista.com','JPY','8345573e-e869-3358-b7e9-07125de9c9a3','1976-04-22 06:00:00',NULL,NULL),
(255,39,'Carlota Rendón','vanegas.teresa','+34 942342591','oscar86@gmail.com','UAH','a1874d78-64eb-3e0b-95e8-e60389fb9bf0','1974-12-22 06:00:00',NULL,NULL),
(256,42,'Srta. Nahia Madrigal','aitor46','+34 926-44-9983','nahia11@hotmail.com','XAF','a5c09db9-62e6-331a-933a-6f9e5524f4bb','1977-10-16 06:00:00',NULL,NULL),
(257,12,'Aitana Tamez','herrero.ana','953 233441','plopez@yahoo.es','KHR','73a2ad23-8950-3eb7-9275-929e003f1fca','2001-03-13 06:00:00',NULL,NULL),
(258,11,'Lic. Nerea Candelaria','nadia.ulloa','+34 907-944815','alvaro28@hispavista.com','BIF','cc78c27d-1fca-356e-b688-4a9e8af2312c','2012-03-28 06:00:00',NULL,NULL),
(259,24,'Biel Paz','biel.holguin','964 45 4367','ngimenez@yahoo.es','RSD','b2f8b749-4d70-3f87-8249-ed334d52fff1','1984-11-19 06:00:00',NULL,NULL),
(260,29,'Carmen Luis','rosario52','+34 974891867','hcastellano@yahoo.com','BRL','8aeaaaa6-8f34-35ff-8e02-acb34d4b6c6a','2001-12-17 06:00:00',NULL,NULL),
(261,29,'Dr. Nora Saldivar','opabon','902788476','xaguilera@live.com','UGX','09bd35cd-05dc-3f34-ba8e-f99914ac64b9','1998-11-23 06:00:00',NULL,NULL),
(262,31,'Rosario Acuña Segundo','dario38','+34 934-199751','rafael.urrutia@terra.com','DOP','364ba184-1c0f-3a23-be09-ea575150a6dc','2003-12-03 06:00:00',NULL,NULL),
(263,46,'Lic. Ana Cortés','abril28','984-60-9389','rueda.victoria@terra.com','GTQ','ecb75724-6fdd-31ba-99cc-0f273498b7ef','2005-09-20 05:00:00',NULL,NULL),
(264,42,'Antonio Zamora','caraballo.miguel','918-425233','alma14@hispavista.com','MOP','a35e5e35-cda6-3eec-983b-506a78d3b599','2006-02-27 06:00:00',NULL,NULL),
(265,24,'Mateo Vanegas','yago.reina','+34 994-10-3767','htello@latinmail.com','IRR','5d453946-d736-3a63-b20c-38b7bf594b1a','2005-03-23 06:00:00',NULL,NULL),
(266,6,'Verónica Cepeda','ismael22','916 404030','nerea.pantoja@yahoo.es','TJS','cf6451a0-7d43-3755-9157-749d394b6cb4','2022-10-07 05:00:00',NULL,NULL),
(267,10,'Nayara Ruelas','teresa70','905-68-9307','munoz.santiago@live.com','PLN','3b9c82a3-fedb-34ba-b4f5-b956244c655a','2001-11-15 06:00:00',NULL,NULL),
(268,42,'Francisco Javier Urbina','noa.beltran','+34 971784654','roberto50@hispavista.com','AMD','e835ecca-6eac-3c86-8f87-30a3f35e367f','2007-09-04 05:00:00',NULL,NULL),
(269,21,'Dr. Pedro Báez Hijo','yolanda77','919 03 4993','patricia.mora@hotmail.es','SLL','482a1e17-2a2e-3b52-bf6b-8a8e352030dd','1995-04-18 06:00:00',NULL,NULL),
(270,6,'Gonzalo Jasso Hijo','zorosco','983-382438','andres28@terra.com','FKP','7662edf2-6474-3657-829d-287e73af7ffc','2021-03-11 06:00:00',NULL,NULL),
(271,2,'Inés Quiñónez','aleix75','+34 948 575811','flara@hotmail.com','FJD','fa9f1561-b4ad-3e7f-a045-fc46c95f480a','2005-07-30 05:00:00',NULL,NULL),
(272,43,'Sra. Fátima Paredes','aleix.zambrano','919 06 1015','aaron.burgos@gmail.com','PYG','1c349780-6934-359d-833e-6cf27fe8aab3','2019-04-27 05:00:00',NULL,NULL),
(273,11,'Aurora Figueroa','kgalindo','+34 949 88 8453','zmadera@yahoo.es','LYD','5ecfb616-1574-3f4c-bb06-3af52f1c7875','1980-10-28 06:00:00',NULL,NULL),
(274,41,'Lic. Oriol Cabrera','ivera','902-666113','franciscojavier97@yahoo.com','CNY','730fa4f5-75e5-3aa3-8780-ef7019d240ab','2008-12-20 06:00:00',NULL,NULL),
(275,44,'Sr. Rafael Jaramillo Hijo','malak78','+34 943 171827','ksaez@terra.com','RWF','86857c20-a08e-3e1c-a816-df183b22eb17','1976-04-10 06:00:00',NULL,NULL),
(276,2,'D. Óscar Casárez','vblanco','969 68 5731','roberto.renteria@terra.com','BND','563f4d5a-c501-3f4f-8a56-e9f886033c95','1974-08-20 06:00:00',NULL,NULL),
(277,37,'Javier Salcedo Hijo','huerta.aleix','+34 927 456976','nadia.alicea@latinmail.com','MMK','576a489f-e80b-3962-bf19-cbc739b22ee6','2018-11-26 06:00:00',NULL,NULL),
(278,25,'Adrián Vázquez','vmuro','938 961162','zmanzano@terra.com','LBP','f8b4b070-beaf-3371-9189-f7af706ba754','2015-12-17 06:00:00',NULL,NULL),
(279,48,'Daniel Paredes','miguel89','+34 908021472','klomeli@yahoo.es','SSP','b22724f5-d5d4-38f5-85f4-718546972e03','1998-12-22 06:00:00',NULL,NULL),
(280,46,'Yago Barrientos','joel47','+34 905 707890','ainara84@yahoo.es','INR','1e6265ef-72fa-3441-bbfd-0bb9bb2dc85d','1979-09-14 06:00:00',NULL,NULL),
(281,13,'Rafael Moral Segundo','ona48','998-349960','jaime.patino@terra.com','MYR','aafddf5d-db6d-366b-a84b-f22df2d5db02','1989-09-02 06:00:00',NULL,NULL),
(282,31,'Lic. Alonso Paredes Hijo','mercado.emilia','953-73-3321','kaltamirano@live.com','TRY','e6999f95-0f65-3da5-a511-cd09dc927f03','1976-03-02 06:00:00',NULL,NULL),
(283,43,'Enrique Varela','anaisabel.galvan','+34 904-17-6338','mena.valeria@yahoo.es','VES','230f9443-e0c3-3a54-80e9-d11c8a7dadaa','2021-10-11 05:00:00',NULL,NULL),
(284,41,'Carlota Partida','pol54','934-52-0500','nil.reynoso@hispavista.com','GEL','ac0c06e0-94a2-3654-8e6d-8678309fb166','2016-10-23 05:00:00',NULL,NULL),
(285,6,'Luna Orozco','mosorio','984-408689','apodaca.vera@hotmail.es','UYU','64157df0-2802-37aa-b789-26989e20f7dc','2022-06-13 05:00:00',NULL,NULL),
(286,22,'Olga Gálvez','alonso.tapia','+34 944-600689','eesquibel@gmail.com','HTG','ba16e7d8-68f9-34eb-93fb-04afee8db5db','2021-03-26 06:00:00',NULL,NULL),
(287,6,'Lic. Leo Rangel Hijo','izapata','916 138363','ozarate@hotmail.com','VES','7eff4c77-81de-3f86-bf47-29203f4f8882','1994-11-13 06:00:00',NULL,NULL),
(288,6,'Ismael Acosta Tercero','nunez.hector','+34 965619830','juanjose.benavidez@terra.com','KWD','28ccdfae-6200-36db-a67d-7c73b776d2dd','2015-05-22 05:00:00',NULL,NULL),
(289,36,'Ing. Juan José Escamilla','yledesma','+34 938857689','nil.gurule@hispavista.com','MYR','175fd0c6-d441-3209-acd9-5997d10e41e7','1979-03-21 06:00:00',NULL,NULL),
(290,8,'Juan José Quiñónez','ftijerina','+34 940612282','mdelafuente@hotmail.es','GEL','6210a356-f81a-3663-b83b-b077757c91c6','2010-05-10 05:00:00',NULL,NULL),
(291,42,'Natalia Delagarza','berta54','+34 954-99-2746','montanez.fernando@yahoo.com','TMT','433c8b93-e71c-35d5-8a70-708a8f5476b9','2016-05-01 05:00:00',NULL,NULL),
(292,43,'Alejandro Lara','linares.eric','979-60-9366','cantu.alejandro@yahoo.es','SDG','b8bbead5-d05a-3811-95e3-965923b546a7','2018-12-14 06:00:00',NULL,NULL),
(293,32,'Samuel Marín Hijo','irene.arguello','987 22 3724','bmelgar@yahoo.com','HUF','c7dddad0-cdd5-33ad-940c-7f11c3a0acaf','1971-09-02 06:00:00',NULL,NULL),
(294,6,'Sr. Biel Mateos Segundo','raul49','907 150631','esther.aguayo@hotmail.es','PYG','fcbcd8cc-bb4f-3355-a1f0-c4135b8ebc5a','1995-07-14 06:00:00',NULL,NULL),
(295,45,'Lic. Rosa Reséndez','andrea.valenzuela','+34 914-38-1149','nuria.espinal@gmail.com','ETB','52c894bb-4985-39ca-a198-29d2fb50ccc1','1993-02-18 06:00:00',NULL,NULL),
(296,28,'Jordi Merino','bermudez.josefa','+34 929-382570','iplaza@hotmail.com','RUB','7503f42f-8803-36c1-a42f-69629597b468','2000-02-09 06:00:00',NULL,NULL),
(297,7,'Andrea Alaniz','amparo05','991494007','emilia49@terra.com','SHP','c17a85e8-a038-343c-b807-fe21c69c08df','2021-03-06 06:00:00',NULL,NULL),
(298,40,'D. Gael Aparicio','mateo80','959-61-4464','gamboa.biel@hotmail.es','GNF','aebd4bbf-ea4e-394e-9feb-07b4ee94186d','2001-07-06 05:00:00',NULL,NULL),
(299,50,'Juan José Cardona','marta81','+34 904-39-5890','hector.mendoza@hotmail.es','BIF','f07baa0d-f183-3550-b7bb-20811426072b','2015-08-07 05:00:00',NULL,NULL),
(300,28,'Omar Curiel','mendoza.nahia','+34 957 82 5081','claudia.salcedo@hotmail.com','BZD','94cd2e3e-40b8-35ae-a7c1-564d98663b3a','2000-09-20 05:00:00',NULL,NULL),
(301,1,'Marcos Calero','gmartinez','951 098767','szaragoz@live.com','BBD','63877574c118a','2022-11-30 15:23:32','2022-11-30 15:23:32',NULL),
(302,1,'Marcos Caleroa','gmartineza','951 098767a','szaragoza@live.com','BBD','638775b32c226','2022-11-30 15:24:35','2022-11-30 15:24:35',NULL);

```

