# Prueba Tecnica  -Grupo Perinola -

sistema para llevar que lleva el control de horas de los empleados que laboran de forma freelance
### Clonar el Repositorio de git

```bash
git clone https://github.com/JosiasMisael/prueba-solunovas
```

### Moverse al directorio del proyecto

```bash
cd prueba-solunovas
```

### Descargar Dependencias del Proyecto

Como las dependencias del proyecto las maneja **composer** debemos ejecutar el comando:

```bash
composer install
```

### Configurar Entorno

La configuración del entorno se hace en el archivo **.env** pero esé archivo no se puede versionar según las restricciones del archivo **.gitignore**, igualmente en el proyecto hay un archivo de ejemplo  **.env.example** debemos copiarlo con el siguiente comando:

```bash
cp .env.example .env
```

Luego es necesario modificar los valores de las variables de entorno para adecuar la configuración a nuestro entorno de desarrollo, por ejemplo los parámetros de conexión a la base de datos.

### Migrar la Base de Datos

el proyecto ya tiene los modelos, migraciones y seeders generados.

```bash
php artisan migrate:fresh --seed
```


### Nota: Crear una cuenta en **https://mailtrap.io** y configurar las credenciales en el archio **.env.** para poder enviar credenciales de nuevos usuarios.
