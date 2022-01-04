document.addEventListener("DOMContentLoaded", function () {

  //Administrador
  mostrarPaginaUsuarios(1);
  borrarAlertas(); 

});

async function mostrarPaginaUsuarios(page) {
  try {
    const url = "/index.php/paginacion?page=" + page;
    const resultado = await fetch(url, { method: "GET" });
    respuesta = await resultado.json();
    crearTabla(respuesta);
  } catch (e) {
    console.log(e);
  }
}

function crearTabla(respuesta) {
  const { current_page, records, records_by_page, total_records } = respuesta;

  const infoUsuarios = document.querySelector("#infoUsuarios");
  infoUsuarios.innerHTML = ` `;
  //$("#infoUsuarios").empty();

  for (let i = 0; i < records.resultados.length; i++) {
    const nuevoTr = document.createElement("tr");

    const id = document.createElement("td");
    id.setAttribute("data-title", "#");

    const nombre = document.createElement("td");
    nombre.setAttribute("data-title", "Nombre");

    const apellido = document.createElement("td");
    apellido.setAttribute("data-title", "Apellido");

    const email = document.createElement("td");
    email.setAttribute("data-title", "E-mail");

    const puntos = document.createElement("td");
    puntos.setAttribute("data-title", "Puntos");

    const botones = document.createElement("td");

    const contenedorBotones = document.createElement("div");
    contenedorBotones.className = "d-grid gap-2 mt-0";

    const actualizar = document.createElement("a");
    actualizar.className = "btn btn-lg mt-0 boton-amarillo";
    actualizar.textContent = "Actualizar";
    actualizar.setAttribute("id", "actualizar");
    actualizar.setAttribute("href", "/index.php/admin/actualizarUsuario?usuario="+records.resultados[i].id);

    const borrar = document.createElement("a");
    borrar.className = "btn btn-lg mt-0 boton-rojo borrarUsuario";
    borrar.textContent = "Borrar";
    borrar.setAttribute("id", "borrar");
    // Valor con la id
    borrar.value = records.resultados[i].id;
    // clase donde escuchar
    //borrar.setAttribute("href", "/index.php/admin/borrarUsuario?usuario="+records.resultados[i].id);

    contenedorBotones.appendChild(actualizar);
    contenedorBotones.appendChild(borrar);
    botones.appendChild(contenedorBotones);

    id.textContent = records.resultados[i].id;
    nombre.textContent = records.resultados[i].nombre;
    apellido.textContent = records.resultados[i].apellido;
    email.textContent = records.resultados[i].email;
    puntos.textContent = records.resultados[i].puntos;

    nuevoTr.appendChild(id);
    nuevoTr.appendChild(nombre);
    nuevoTr.appendChild(apellido);
    nuevoTr.appendChild(email);
    nuevoTr.appendChild(puntos);
    nuevoTr.appendChild(botones);

    infoUsuarios.appendChild(nuevoTr);
  } // Fin del for

  crearPaginador(current_page, records_by_page, total_records);
}

function crearPaginador(current_page, records_by_page, total_records) {
  totalPaginas = total_records / records_by_page;

  if (current_page == 1) {
    primeraPagina = null;
  } else {
    primeraPagina = 1;
  }

  if (current_page - 1 <= 0) {
    anteriorPagina = null;
  } else {
    anteriorPagina = current_page - 1;
  }

  if (current_page + 1 > Math.ceil(totalPaginas)) {
    siguientePagina = null;
  } else {
    siguientePagina = current_page + 1;
  }

  if (current_page == totalPaginas || current_page == Math.ceil(totalPaginas)) {
    ultimaPagina = null;
  } else {
    ultimaPagina = Math.ceil(totalPaginas);
  }

  const marcadorPagina = document.querySelector('#marcadorPagina');
  marcadorPagina.innerHTML = `
    <p> Pagina ${current_page} de ${Math.ceil(totalPaginas)} </p>
  `;


  if (document.querySelector("#paginacion-agenda")) {
    document.querySelector("#paginacion-agenda").remove();
  }

  const paginacion = document.createElement("div");
  paginacion.setAttribute("id", "paginacion-agenda");

  // Botón Primera Página
  const imgPrimera = document.createElement("img");
  imgPrimera.setAttribute("class", "center");
  imgPrimera.setAttribute("src", "/build/img/arrow-bar-left.svg");
  const primera = document.createElement("div");
  primera.setAttribute("id", "primera");
  //primera.setAttribute("value", primeraPagina);
  primera.value = primeraPagina;
  primera.appendChild(imgPrimera);
  if (primeraPagina === null) {
    primera.className = "disabled";
  }

  // Botón Anterior Página
  const imgAnterior = document.createElement("img");
  imgAnterior.setAttribute("class", "center");
  imgAnterior.setAttribute("src", "/build/img/arrow-left.svg");
  const anterior = document.createElement("div");
  anterior.setAttribute("id", "anterior");
  //anterior.setAttribute("value", anteriorPagina);
  anterior.value = anteriorPagina;
  anterior.appendChild(imgAnterior);
  if (anteriorPagina === null) {
    anterior.className = "disabled";
  }

  // Botón Siguiente Página
  const imgSiguiente = document.createElement("img");
  imgSiguiente.setAttribute("class", "center");
  imgSiguiente.setAttribute("src", "/build/img/arrow-right.svg");
  const siguiente = document.createElement("div");
  siguiente.setAttribute("id", "siguiente");
  //siguiente.setAttribute("value", siguientePagina);
  siguiente.value = siguientePagina;
  siguiente.appendChild(imgSiguiente);
  if (siguientePagina === null) {
    siguiente.className = "disabled";
  }

  // Botón Primera Página
  const imgUltima = document.createElement("img");
  imgUltima.setAttribute("class", "center");
  imgUltima.setAttribute("src", "/build/img/arrow-bar-right.svg");
  const ultima = document.createElement("div");
  ultima.setAttribute("id", "ultima");
  //ultima.setAttribute("value", ultimaPagina);
  ultima.value = ultimaPagina;
  ultima.appendChild(imgUltima);
  if (ultimaPagina === null) {
    ultima.className = "disabled";
  }

  paginacion.appendChild(primera);
  paginacion.appendChild(anterior);
  paginacion.appendChild(siguiente);
  paginacion.appendChild(ultima);

  const paging = document.querySelector("#tfoot-paging");
  paging.appendChild(paginacion);

  escucharBotones();
}

function escucharBotones() {
  primera = document.querySelector("#primera");
  if (primera.value != null) {
    primera.addEventListener("click", function (e) {
      mostrarPaginaUsuarios(primera.value);
    });
  }

  anterior = document.querySelector("#anterior");
  if (anterior.value != null) {
    anterior.addEventListener("click", function (e) {
      mostrarPaginaUsuarios(anterior.value);
    });
  }

  siguiente = document.querySelector("#siguiente");
  if (siguiente.value != null) {
    siguiente.addEventListener("click", function (e) {
      mostrarPaginaUsuarios(siguiente.value);
    });
  }

  ultima = document.querySelector("#ultima");
  if (ultima.value != null) {
    ultima.addEventListener("click", function (e) {
      mostrarPaginaUsuarios(Math.ceil(ultima.value));
    });
  }

  borrarUsuario = document.getElementsByClassName("borrarUsuario");

  for (let i = 0; i < borrarUsuario.length; i++) {
    const btn = borrarUsuario[i];
    
    btn.addEventListener("click", function(){
      //console.log(this.value)
      
      Swal.fire({
        title: '¿Estás seguro de querer eliminar al usuario con  la  id ' + this.value + '?',
        text: "¡Este cambio no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminarlo!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            '¡Borrado!',
            ' El usuario ha sido borrado correctamente',
            'success'
          )
        }
      })

    })
  }





}

function borrarAlertas(){
 
  const alertas = document.querySelectorAll('.alerta');

  alertas.forEach(function (alert){

        setTimeout(function () {
          alert.remove();
        },3000)
  })

}