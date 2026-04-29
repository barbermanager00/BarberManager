<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Turnos - Barber Manager</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #d4af37;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #f0c859;
        }

        .logo {
            font-size: 50px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 36px;
            color: #fff;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #d4af37;
            font-size: 14px;
        }

        .form-container {
            background: linear-gradient(135deg, #2a2a2a 0%, #1f1f1f 100%);
            border: 3px solid #d4af37;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            margin-bottom: 50px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #d4af37;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }

        input::placeholder {
            color: #666;
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #d4af37 0%, #c99e2b 100%);
            color: #000;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        /* Panel de Errores */
        #panel-errores {
            background-color: #d32f2f;
            color: #fff;
            border: 2px solid #c62828;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: none;
        }

        #panel-errores strong {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        #lista-errores {
            list-style: none;
            padding-left: 0;
        }

        #lista-errores li {
            padding: 5px 0;
            padding-left: 20px;
            position: relative;
        }

        #lista-errores li:before {
            content: "✗";
            position: absolute;
            left: 0;
        }

        /* Sección de Turnos */
        .turnos-section {
            margin-top: 50px;
        }

        .turnos-section h2 {
            font-size: 28px;
            color: #fff;
            margin-bottom: 30px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #d4af37;
        }

        /* Estilos de la Tabla */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: linear-gradient(135deg, #2a2a2a 0%, #1f1f1f 100%);
            border: 2px solid #d4af37;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        th {
            background: linear-gradient(135deg, #d4af37 0%, #c99e2b 100%);
            color: #000;
            padding: 15px;
            text-align: left;
            font-weight: bold;
            font-size: 14px;
        }

        td {
            padding: 15px;
            color: #aaa;
            border-bottom: 1px solid #333;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: rgba(212, 175, 55, 0.1);
            color: #fff;
        }

        .sin-datos {
            text-align: center;
            padding: 40px 15px;
            color: #666;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            h1 {
                font-size: 28px;
            }

            table {
                font-size: 12px;
            }

            td,
            th {
                padding: 10px;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="/" class="back-link">← Volver al inicio</a>
            <div class="logo">✂️</div>
            <h1>Reservar Nuevo Turno</h1>
            <p class="subtitle">Agenda tu cita con nuestros barberos</p>
        </div>

        <div class="form-container">

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
        </div>

        <div class="turnos-section">
            <h2>📅 Próximos Turnos Agendados</h2>
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
                    <tr>
                        <td colspan="6" class="sin-datos">Cargando turnos...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="/Barber_Manager/js/app.js"></script>

</body>

</html>