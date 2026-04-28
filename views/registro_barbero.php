<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Barbero - Barber Manager</title>
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
            padding: 20px;
        }

        .container {
            max-width: 600px;
            width: 100%;
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
        textarea:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }

        input::placeholder {
            color: #666;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-container {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background: #d4af37;
            color: #000;
        }

        .btn-submit:hover {
            background: #f0c859;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        .btn-cancel {
            background: #555;
            color: #fff;
        }

        .btn-cancel:hover {
            background: #666;
        }

        .btn:active {
            transform: translateY(0);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        .success-message {
            display: none;
            background: #51cf66;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .required {
            color: #ff6b6b;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="/Barber_Manager/" class="back-link">← Volver</a>
            <div class="logo">💈</div>
            <h1>Registro de Barbero</h1>
            <p class="subtitle">Completa el formulario para unirte</p>
        </div>

        <div class="form-container">
            <div class="success-message" id="successMessage">
                ¡Registro exitoso! Redirigiendo...
            </div>

            <form id="registroForm" method="POST" action="/Barber_Manager/barberos">
                <!-- Nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre Completo <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        placeholder="Ej: Juan Pérez" 
                        required
                        minlength="3"
                    >
                    <div class="error-message" id="error-nombre"></div>
                </div>

                <!-- Email y Teléfono -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Ej: juan@barberia.com" 
                            required
                        >
                        <div class="error-message" id="error-email"></div>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono <span class="required">*</span></label>
                        <input 
                            type="tel" 
                            id="telefono" 
                            name="telefono" 
                            placeholder="Ej: 1234567890" 
                            required
                            pattern="\d+"
                        >
                        <div class="error-message" id="error-telefono"></div>
                    </div>
                </div>

                <!-- Especialidad y Experiencia -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="especialidad">Especialidad <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="especialidad" 
                            name="especialidad" 
                            placeholder="Ej: Cortes, Afeitado" 
                            required
                            minlength="2"
                        >
                        <div class="error-message" id="error-especialidad"></div>
                    </div>

                    <div class="form-group">
                        <label for="experiencia">Años de Experiencia <span class="required">*</span></label>
                        <input 
                            type="number" 
                            id="experiencia" 
                            name="experiencia" 
                            placeholder="Ej: 5" 
                            required
                            min="0"
                            max="70"
                        >
                        <div class="error-message" id="error-experiencia"></div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="btn-container">
                    <button type="button" class="btn btn-cancel" onclick="window.location.href='/Barber_Manager/'">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-submit">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('registroForm');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Limpiar errores previos
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
                el.textContent = '';
            });

            // Obtener datos
            const formData = new FormData(form);

            try {
                const response = await fetch('/Barber_Manager/barberos', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.ok) {
                    // Mostrar mensaje de éxito
                    document.getElementById('successMessage').style.display = 'block';
                    form.style.opacity = '0.5';
                    form.style.pointerEvents = 'none';

                    // Redirigir después de 2 segundos
                    setTimeout(() => {
                        window.location.href = '/Barber_Manager/';
                    }, 2000);
                } else {
                    // Mostrar errores
                    if (data.errors && Array.isArray(data.errors)) {
                        data.errors.forEach(error => {
                            const field = document.getElementById('error-' + Object.keys(form.elements).find(key => form[key]?.value));
                            if (!field) {
                                // Si no coincide con un campo específico, mostrar en el primero
                                const firstError = document.querySelector('.error-message');
                                if (firstError) {
                                    firstError.textContent = error;
                                    firstError.style.display = 'block';
                                }
                            }
                        });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error en la conexión. Intenta nuevamente.');
            }
        });

        // Validación en tiempo real
        document.getElementById('nombre').addEventListener('blur', function() {
            if (this.value.length < 3 && this.value.length > 0) {
                document.getElementById('error-nombre').textContent = 'Mínimo 3 caracteres';
                document.getElementById('error-nombre').style.display = 'block';
            }
        });

        document.getElementById('email').addEventListener('blur', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                document.getElementById('error-email').textContent = 'Email inválido';
                document.getElementById('error-email').style.display = 'block';
            }
        });

        document.getElementById('telefono').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });

        document.getElementById('experiencia').addEventListener('change', function() {
            const val = parseInt(this.value);
            if (val < 0 || val > 70) {
                document.getElementById('error-experiencia').textContent = 'Debe estar entre 0 y 70 años';
                document.getElementById('error-experiencia').style.display = 'block';
            }
        });
    </script>
</body>
</html>
