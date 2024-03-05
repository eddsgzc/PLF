const houses = document.querySelectorAll('.house');

houses.forEach(house => {
    house.addEventListener('click', mostrarDetalles);                                       //evento click
});

function mostrarDetalles(event) {
    const selectedHouse = event.currentTarget;                                              //casa seleccionada
    alert('Detalles de la casa:\n' + selectedHouse.querySelector('h2').textContent);        //mostrar detalles
}
