# 💈 Sistema de Reserva de Turnos - Barbería

![Backend](https://img.shields.io/badge/Backend-Java_17-orange)
![Framework](https://img.shields.io/badge/Framework-Spring_Boot_3.x-green)
![DB](https://img.shields.io/badge/DB-H2-blue)

## 📝 Descripción General
API REST diseñada para la gestión eficiente de turnos en una barbería. Permite a los clientes reservar citas online seleccionando barberos, fechas y horarios, optimizando la agenda y eliminando la coordinación manual.

### 👥 Integrantes del Grupo
| Nombre Completo | Legajo |
| :--- | :--- |
| Geist Nahuel | 18395 |
| Medrano Germán | 18373 |

---

## 🚀 MVP (Producto Mínimo Viable)

### Funcionalidad Core
* **Registro de Reservas:** Los clientes pueden agendar turnos según disponibilidad.
* **Gestión Administrativa:** Visualización de la agenda diaria y control de estados (Pendiente, Confirmado, Cancelado).

### Alcance Inicial
* ✅ Registro y consulta de barberos.
* ✅ CRUD completo de turnos (Creación, Listado, Actualización, Cancelación).
* ✅ Filtros de búsqueda por barbero o fecha.
* ⚠️ *Nota: No incluye sistema de autenticación en esta iteración.*

---

## 🛠️ Stack Tecnológico
| Capa | Tecnología |
| :--- | :--- |
| **Lenguaje** | Java 17+ |
| **Framework** | Spring Boot 3.x |
| **Persistencia** | Spring Data JPA / Hibernate |
| **Base de Datos** | H2 (Memoria / Desarrollo) |
| **Build Tool** | Maven |

---

## 📊 Modelo de Datos

### Entidades Principales

#### 🗓️ Turno
| Atributo | Tipo Java | Descripción |
| :--- | :--- | :--- |
| `id` | `Long` | PK Autoincremental. |
| `fecha` | `LocalDate` | Fecha del servicio. |
| `hora` | `LocalTime` | Hora del servicio. |
| `clienteNombre` | `String` | Nombre del cliente (Max 100 char). |
| `clienteTelefono`| `String` | Teléfono (Max 20 char). |
| `estado` | `EstadoTurno` | Enum: `PENDIENTE`, `CONFIRMADO`, `CANCELADO`. |
| `barbero` | `Barbero` | FK al barbero asignado. |

#### ✂️ Barbero
| Atributo | Tipo Java | Descripción |
| :--- | :--- | :--- |
| `id` | `Long` | PK Autoincremental. |
| `nombre` | `String` | Nombre completo. |
| `especialidad` | `String` | Ej: Clásico, degradé, barba. |
| `disponible` | `Boolean` | Estado de actividad (Default: `true`). |

### Relación: 1:N
Un **Barbero** puede tener muchos **Turnos**, pero un **Turno** pertenece a un único **Barbero**.

---

## 🛡️ Reglas de Negocio y Validaciones

### Turnos
* 🚫 No se permiten fechas u horas en el pasado.
* ⚠️ `clienteNombre`, `clienteTelefono` y `barberoId` son campos obligatorios.
* 📅 **Conflicto de Agenda:** No se permiten dos turnos para el mismo barbero en la misma fecha y hora.

### Estados (Flujo Permitido)
1.  `PENDIENTE` ➡️ `CONFIRMADO` o `CANCELADO`.
2.  `CONFIRMADO` ➡️ `CANCELADO`.
3.  `CANCELADO` ➡️ *Estado final (Bloqueado).*

---

## 🔌 API Endpoints

### 🩺 Health Check
* `GET /health`: Verifica el estado del servidor.

### ✂️ Barberos
* `GET /barberos`: Listar equipo completo.
* `POST /barberos`: Registrar nuevo barbero.

### 📅 Turnos
| Método | Endpoint | Descripción |
| :--- | :--- | :--- |
| `GET` | `/turnos` | Lista general (Filtro opcional `?fecha=YYYY-MM-DD`). |
| `POST` | `/turnos` | Crea una nueva reserva. |
| `PATCH` | `/turnos/{id}/estado` | Cambia el estado (Confirmar/Cancelar). |

---

## ⚠️ Manejo de Errores
Estructura estándar de respuesta para fallos:
```json
{
  "timestamp": "2025-05-15T10:30:00",
  "status": 400,
  "error": "Bad Request",
  "message": "Mensaje descriptivo del error"
}
