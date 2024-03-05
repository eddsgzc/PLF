document.getElementById('subirCasaForm').addEventListener('submit', function(event) {
    event.preventDefault();                                                                                 //evita enviar el formulario
                                                                                                            //obtiene los valores del formulario
    const titulo = document.getElementById('titulo').value;
    const estado = document.getElementById('estado').value;
    const municipio = document.getElementById('municipio').value;
    const precio = document.getElementById('precio').value;
    const estatus = document.getElementById('estatus').value;

    const newHouseData = {                                                                                  //se crea el objeto con  los datos de la casa
        titulo: titulo,
        estado: estado,
        municipio: municipio,
        precio: precio,
        estatus: estatus
    };
                                                                                                            //guarda los datos en el local
    let casas = JSON.parse(localStorage.getItem('casas')) || [];
    casas.push(newHouseData);
    localStorage.setItem('casas', JSON.stringify(casas));
                                                                                                            //redirige a la pagina despues de guardar
    window.location.href = "CasaEnVenta.html";
});
