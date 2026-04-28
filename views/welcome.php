<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barber Manager - Bienvenida</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }

        .container {
            text-align: center;
            max-width: 800px;
            width: 90%;
        }

        .header {
            margin-bottom: 60px;
        }

        .logo {
            font-size: 60px;
            margin-bottom: 20px;
            animation: fadeInDown 0.8s ease-out;
        }

        h1 {
            font-size: 48px;
            color: #fff;
            margin-bottom: 10px;
            animation: fadeInDown 0.8s ease-out 0.1s both;
        }

        .subtitle {
            font-size: 18px;
            color: #d4af37;
            margin-bottom: 50px;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .option-card {
            padding: 40px;
            background: linear-gradient(135deg, #2a2a2a 0%, #1f1f1f 100%);
            border: 3px solid #d4af37;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }

        .option-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.3);
            background: linear-gradient(135deg, #333333 0%, #2a2a2a 100%);
        }

        .option-card.cliente {
            animation-delay: 0.3s;
        }

        .option-card.barbero {
            animation-delay: 0.4s;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .option-card h2 {
            font-size: 28px;
            color: #fff;
            margin-bottom: 15px;
        }

        .option-card p {
            font-size: 14px;
            color: #aaa;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #d4af37;
            color: #000;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #f0c859;
            transform: scale(1.05);
        }

        .btn:active {
            transform: scale(0.98);
        }

        .footer {
            margin-top: 60px;
            color: #888;
            font-size: 12px;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .options {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 36px;
            }

            .option-card {
                padding: 30px;
            }

            .option-card h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">✂️</div>
            <h1>BARBER MANAGER</h1>
            <p class="subtitle">Tu Sistema de Gestión de Barbería</p>
        </div>

        <div class="options">
            <!-- Opción Cliente -->
            <div class="option-card cliente">
                <div class="icon">👤</div>
                <h2>Soy Cliente</h2>
                <p>Solicita un turno con tu barbero favorito. Rápido, fácil y sin esperas.</p>
                <form action="" method="GET" style="display: inline;">
                    <input type="hidden" name="rol" value="cliente">
                    <button type="submit" class="btn">Agendar Turno</button>
                </form>
            </div>

            <!-- Opción Barbero -->
            <div class="option-card barbero">
                <div class="icon">💈</div>
                <h2>Soy Barbero</h2>
                <p>Únete a nuestra comunidad. Regístrate y comienza a recibir clientes.</p>
                <form action="" method="GET" style="display: inline;">
                    <input type="hidden" name="rol" value="barbero">
                    <button type="submit" class="btn">Registrarse</button>
                </form>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2026 Barber Manager. Todos los derechos reservados.</p>
        </div>
    </div>

    <script>
        // Procesar selección de rol
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const rol = this.querySelector('input[name="rol"]').value;
                    
                    if (rol === 'cliente') {
                        window.location.href = '/Barber_Manager/turnos/nuevo';
                    } else if (rol === 'barbero') {
                        window.location.href = '/Barber_Manager/barberos/registro';
                    }
                });
            });
        });
    </script>
</body>
</html>
