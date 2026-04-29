## 🔧 SOLUCIONAR ERROR EN SQL

Si te sale error al copiar el SQL, sigue esto:

---

## **OPCIÓN 1: La Más Fácil (Recomendada)**

### Paso 1: Abrir phpMyAdmin
1. Ve a: `http://localhost/phpmyadmin`
2. Inicia sesión (usuario: `root`, contraseña: vacía)

### Paso 2: Seleccionar Base de Datos
1. Click izquierdo en `barber_manager_db` (en el menú izquierdo)

### Paso 3: Ejecutar SQL Correcto
1. Click en la pestaña **SQL**
2. **Borra todo** lo que haya en la caja de texto
3. Copia y pega SOLO esto:

```sql
CREATE TABLE barberos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    experiencia INT,
    estado INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_email (email)
);
```

4. Click en el botón **Ejecutar** (abajo a la derecha)

✅ **Debe decir:** "MySQL returned an empty result set (i.e. zero rows)." 

---

## **OPCIÓN 2: Si Aún Falla**

Si aún tienes error, haz esto por partes:

### **Parte 1:** Borrar tabla vieja
```sql
DROP TABLE IF EXISTS barberos;
```
Click ejecutar.

### **Parte 2:** Crear tabla
```sql
CREATE TABLE barberos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    telefono VARCHAR(15),
    especialidad VARCHAR(100),
    experiencia INT,
    estado INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Click ejecutar.

### **Parte 3:** Verificar
```sql
DESCRIBE barberos;
```
Click ejecutar.

Deberías ver una tabla con las columnas listadas.

---

## **OPCIÓN 3: Desde Línea de Comandos (Avanzado)**

Si tienes acceso a la consola MySQL:

```bash
cd "C:\xampp\mysql\bin"

mysql -u root -p barber_manager_db < "C:\xampp\htdocs\Barber_Manager\SQL_ALTERNATIVAS.sql"
```

(cuando pida contraseña, solo presiona Enter)

---

## **❌ Errores Comunes y Soluciones**

### **Error: "Syntax error near 'ENGINE=InnoDB'"**
- **Causa:** phpMyAdmin muy viejo
- **Solución:** Usa OPCIÓN 2 (copia sin ENGINE)

### **Error: "Duplicate entry for key 'unique_email'"**
- **Causa:** Ya existe un registro con ese email
- **Solución:** 
```sql
TRUNCATE TABLE barberos;
```
(Esto borra todos los datos)

### **Error: "Access Denied"**
- **Causa:** Problemas de permisos
- **Solución:** Reinicia XAMPP y vuelve a intentar

### **Error: "Table already exists"**
- **Causa:** La tabla ya está creada
- **Solución:** Ejecuta primero:
```sql
DROP TABLE barberos;
```

---

## **✅ Verificar que Funcionó**

Después de ejecutar, copia esto en SQL y ejecuta:

```sql
SELECT * FROM barberos;
DESCRIBE barberos;
SHOW TABLES;
```

Deberías ver la tabla `barberos` en la lista.

---

## **💡 Archivos SQL Disponibles**

- `SQL_CREAR_TABLA_BARBEROS.sql` → Versión completa (con índices)
- `SQL_ALTERNATIVAS.sql` → Versión simple y robusta

---

¿Qué error exacto te muestra phpMyAdmin? Dime y te doy la solución específica.
