document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM cargado, iniciando carga de barberos...');
    cargarBarberos();
    cargarTurnos();
});

// Cargar barberos dinámicamente en el select
async function cargarBarberos() {
    const selectBarberos = document.getElementById('barberoId');
    console.log('Iniciando carga de barberos...');

    try {
        console.log('Haciendo fetch a /Barber_Manager/barberos');
        const response = await fetch('/Barber_Manager/barberos');

        console.log('Respuesta recibida:', response.status);

        if (!response.ok) {
            throw new Error(`Error ${response.status}: No se pudo obtener los barberos`);
        }

        const text = await response.text();
        console.log('Texto crudo recibido:', text);

        const barberos = JSON.parse(text);
        console.log('Barberos parseados:', barberos);

        // Limpiamos las opciones existentes
        selectBarberos.innerHTML = '<option value="">Seleccione un barbero...</option>';

        // Agregamos cada barbero como opción
        if (Array.isArray(barberos) && barberos.length > 0) {
            barberos.forEach(barbero => {
                const option = document.createElement('option');
                option.value = barbero.id;
                option.textContent = `${barbero.nombre} (${barbero.especialidad})`;
                selectBarberos.appendChild(option);
            });
            console.log('Barberos cargados exitosamente');
        } else {
            selectBarberos.innerHTML = '<option value="">No hay barberos disponibles</option>';
            console.log('No hay barberos activos');
        }
    } catch (error) {
        console.error('Error al cargar barberos:', error);
        selectBarberos.innerHTML = '<option value="">Error al cargar barberos</option>';
    }
}

async function cargarTurnos() {
    const cuerpoTabla = document.getElementById('cuerpo-tabla');

    try {
        // Hacemos el fetch al GET que ya probaste en Postman
        const response = await fetch('/Barber_Manager/turnos');
        const turnos = await response.json();

        // Limpiamos la tabla por si tenía algo
        cuerpoTabla.innerHTML = '';

        // Iteramos los datos y generamos el HTML (Punto 4)
        turnos.forEach(turno => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${turno.clienteNombre}</td>
                <td>${turno.clienteTelefono}</td>
                <td>${turno.nombreBarbero}</td>
                <td>${turno.fecha}</td>
                <td>${turno.hora}</td>
                <td>${turno.servicio || '-'}</td>
            `;
            cuerpoTabla.appendChild(fila);
        });

    } catch (error) {
        console.error('Error al cargar turnos:', error);
    }
}

// Capturamos el formulario (Punto 5)
const form = document.querySelector('form'); // Asegúrate que tu <form> no tenga action ni method en el HTML

form.addEventListener('submit', async (e) => {
    e.preventDefault(); // Evita que la página se recargue (Punto 5)

    const panelErrores = document.getElementById('panel-errores');
    const listaErrores = document.getElementById('lista-errores');

    // Ocultamos errores previos (Punto 6)
    panelErrores.style.display = 'none';
    listaErrores.innerHTML = '';

    // Capturamos los valores de los inputs
    const formData = new FormData(form);

    try {
        // Enviamos los datos al POST que creamos en PHP
        const response = await fetch('/Barber_Manager/turnos', {
            method: 'POST',
            body: formData // Enviamos como FormData para que PHP lo lea en $_POST
        });

        const resultado = await response.json();

        if (response.ok && resultado.ok) {
            // Si todo salió bien:
            alert('¡Turno reservado con éxito!');
            form.reset();      // Limpiamos el formulario
            cargarTurnos();    // Recargamos la tabla para ver el nuevo turno (Punto 4)
        } else {
            // Si hay errores de validación (Punto 6)
            panelErrores.style.display = 'block';
            if (resultado.errors) {
                resultado.errors.forEach(err => {
                    const li = document.createElement('li');
                    li.textContent = err;
                    listaErrores.appendChild(li);
                });
            } else {
                alert('Error: ' + (resultado.error || 'Ocurrió un problema'));
            }
        }
    } catch (error) {
        console.error('Error en la comunicación:', error);
        alert('No se pudo conectar con el servidor.');
    }
});