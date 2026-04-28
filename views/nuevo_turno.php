<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Turno - Barbería</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #34495e;
        }
    </style>
</head>

<body>
    <h1>Reserva de Turno</h1>
    <form method="POST" action="/Barber_Manager/turnos">
        <label>Nombre:
            <input type="text" name="clienteNombre" required>
        </label>

        <label>Teléfono:
            <input type="text" name="clienteTelefono" required>
        </label>

        <label>Barbero:
            <select name="barberoId" required>
                <option value="1">Maximo Pérez</option>
                <option value="2">Marcos López</option>
            </select>
        </label>

        <input type="date" name="fecha" required>
        <input type="time" name="hora" required>

        <button type="submit">Reservar Turno</button>
    </form>
</body>

</html>