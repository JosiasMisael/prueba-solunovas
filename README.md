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

el proyecto ya tiene los modelos, migraciones y seeders generados. Entonces lo único que nos hace falta es ejecutar la migración y ejecutar el siguiente comando:

```bash
php artisan migrate:fresh --seed
```

- **migrate:fresh** ejecuta la migración **eliminando** todas las tablas y volviendo a generarlas.
- **--seed** ejecuta los Seeders habilitados  

### Nota: Para poder agregar nuevos usuarios es necesario tener una cuenta **https://mailtrap.io** donde se enviaran las credenciales de acceso. 
