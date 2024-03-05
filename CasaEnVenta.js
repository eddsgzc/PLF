document.addEventListener('DOMContentLoaded', function() {
    const housesContainer = document.querySelector('main');                                             //contenedor de las casas

    function mostrarDetalles(event) {                                                                   //mostrar detalles con click
        const selectedHouse = event.currentTarget;
        alert('Detalles de la casa:\n' + selectedHouse.querySelector('h2').textContent);
    }

    housesContainer.addEventListener('click', function(event) {                                         //todas las casas con click
        if (event.target.closest('.house')) {
            mostrarDetalles(event);
        }
    });

    let casas = JSON.parse(localStorage.getItem('casas')) || [];                                        //casas guardadas en el alm del formulario

    casas.forEach(casa => {                                                                             //las agrega al formulario de casas en venta
        const newHouse = document.createElement('div');
        newHouse.classList.add('house');
        newHouse.innerHTML = `
            <img src="casa_default.jpg" alt="Casa en Venta">
            <div class="description">
                <h2>${casa.titulo}</h2>
                <p><strong>Estado:</strong> ${casa.estado}</p>
                <p><strong>Municipio:</strong> ${casa.municipio}</p>
                <p><strong>Precio Aproximado:</strong> ${casa.precio}</p>
                <p><strong>Estatus:</strong> ${casa.estatus}</p>
            </div>
        `;
        housesContainer.appendChild(newHouse);
    });
});
