## Checklist de Validación — `POST /turnos`


## Contrato del Endpoint POST

```
Endpoint: POST /turnos
```

### Request Body (JSON)

```json
{
  "cliente":    "string (3-50 chars)",
  "telefono":   "string (7-15 chars, solo números)",
  "barbero_id": "integer (> 0, debe existir en el sistema)",
  "fecha":      "string (formato YYYY-MM-DD)",
  "hora":       "string (formato HH:MM)",
  "servicio":   "string — corte | barba | combo"
}
```

### Response Exitosa (201)

```json
{
   "ok": true,
  "turno": {
    "id":         7,
    "cliente":    "Juan Pérez",
    "telefono":   "3624000000",
    "barbero_id": 2,
    "barbero":    "Marcos",
    "fecha":      "2024-06-10",
    "hora":       "10:30",
    "servicio":   "combo",
    "created_at": "2024-06-08 14:22:00"
  }
}
```

### Response con Errores (400)

```json
{
 "ok": false,
  "errors": {
    "cliente":    "Entre 3 y 50 caracteres",
    "telefono":   "Solo números, entre 7 y 15 dígitos",
    "barbero_id": "Debe ser un ID de barbero válido",
    "fecha":      "Formato inválido, se espera YYYY-MM-DD",
    "hora":       "Formato inválido, se espera HH:MM",
    "servicio":   "Debe ser: corte, barba o combo"
  }
}
```
