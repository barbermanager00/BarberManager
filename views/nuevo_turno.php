<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Turnos - Barber Manager</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #2c3e50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #34495e;
        }

        /* Panel de Errores (Punto 6 del Checklist) */
        #panel-errores {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: none;
        }

        /* Estilos de la Tabla (Punto 3 del Checklist) */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <h1>Reservar Nuevo Turno</h1>

    <div id="panel-errores">
        <strong>Por favor, corrija los siguientes errores:</strong>
        <ul id="lista-errores"></ul>
    </div>

    <form id="form-turno">
        <div class="form-group">
            <label for="clienteNombre">Nombre del Cliente:</label>
            <input type="text" id="clienteNombre" name="clienteNombre" required placeholder="Ej: Juan Pérez">
        </div>

        <div class="form-group">
            <label for="clienteTelefono">Teléfono (8-10 dígitos):</label>
            <input type="tel" id="clienteTelefono" name="clienteTelefono" required placeholder="Ej: 1122334455">
        </div>

        <div class="form-group">
            <label for="barberoId">Barbero:</label>
            <select id="barberoId" name="barberoId" required>
                <option value="">Cargando barberos...</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>

        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>
        </div>

        <div class="form-group">
            <label for="servicio">Servicio (Opcional):</label>
            <input type="text" id="servicio" name="servicio" placeholder="Ej: Corte y Barba">
        </div>

        <button type="submit">Reservar Turno</button>
    </form>

    <hr style="margin-top: 40px;">

    <h2>Próximos Turnos Agendados</h2>
    <table id="tabla-turnos">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Barbero</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
            </tr>
        </thead>
        <tbody id="cuerpo-tabla">
        </tbody>
    </table>

    <script src="/Barber_Manager/js/app.js"></script>

</body>

</html>