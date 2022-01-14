document.addEventListener("DOMContentLoaded", function () {
  // Comprobamos que JS a Iniciado
  //console.log("Iniciando...");
 
  // Utilidades para el Menú modal
  modalListener();
  // Utilidades para el modo Dark
  darkModeListener();
  // Control de cookies
  adminCookies();
  // Control scroll
  scrollNav();

  // Función que uso para desarrollo
  eventListeners();

  btnInicio();

});

function btnInicio(){
  const logo = document.getElementById('logo');
  logo.addEventListener("click", function (e) {
    window.location.href = "/index.php/panelprincipal";
  });
}

function adminCookies() {
  if (getCookie("dark-mode")) {
    if (getCookie("dark-mode") === "false") {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  }
}

function darkModeListener() {

  // Primero comprobamos las preferencias del sistema operativo
  // Si tiene un tema oscuro le cargaremos el dark mode y también
  // si lo cambia durante el uso de la app
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

  // console.log(prefiereDarkMode.matches);

  if (prefiereDarkMode.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  // Cada vez que pulse cambiaremos de modo.
  const botonDarkMode = document.querySelectorAll(".dark-mode-boton");

  // Escucho todos los botones dark-mode (Por si quiero tener varios uno en el header y
  // otro en el footer además como en el login tengo puedo o no mostrar el header)
  for (let i = 0; i < botonDarkMode.length; i++) {
    const element = botonDarkMode[i];
    element.addEventListener("click", function () {
      document.body.classList.toggle("dark-mode");

      //let x = document.cookie;
      //console.log(x);

      // Le ponemos una cookie si cambia dark-mode para conservarlo
      // en la sesión

      //deleteCookie("dark-mode");

        if (getCookie("dark-mode") === "false") {
          //deleteCookie("dark-mode");
          setCookie("dark-mode", "true", 30);
        } else {
          //deleteCookie("dark-mode");
          setCookie("dark-mode", "false", 30);
        }


    });
  }
}

function getCookie(name) {
  // Split cookie string and get all individual name=value pairs in an array
  var cookieArr = document.cookie.split(";");

  // Loop through the array elements
  for (var i = 0; i < cookieArr.length; i++) {
    var cookiePair = cookieArr[i].split("=");

    /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
    if (name == cookiePair[0].trim()) {
      // Decode the cookie value and return
      return decodeURIComponent(cookiePair[1]);
    }
  }

  // Return null if not found
  return null;
}

function setCookie(name, value, daysToLive) {

  deleteCookie("dark-mode");
  // Encode value in order to escape semicolons, commas, and whitespace
  var cookie = name + "=" + encodeURIComponent(value);

  if (typeof daysToLive === "number") {
    /* Sets the max-age attribute so that the cookie expires
        after the specified number of days */
    cookie += "; max-age=" + daysToLive * 24 * 60 * 60 +"; path=/" ; // Importante el path para que no se duplique la cookie en otra página uffff :D

    document.cookie = cookie;
  }
}

function deleteCookie(name) {
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function scrollNav() {
  // Lo que voy a mostrar cuando se valla acercando al footer
  const menuUp = document.getElementById("up");

  // El header
  const headerPosition = document.getElementsByTagName("header");

  // Sección Principal
  const contenedor = document.querySelector(".contenedor");

  if (menuUp) {
    // Escuchamos el click al boton y hacemos scroll al header con una animación suave.
    menuUp.addEventListener("click", function (e) {
      headerPosition[0].scrollIntoView({ behavior: "smooth" });
    });

    // Escuchamos el scroll
    window.addEventListener("scroll", function () {
      //console.log(headerPosition[0].getBoundingClientRect().top);

      if (headerPosition[0].getBoundingClientRect().top < -110) {
        //console.log('130?'+ headerPosition[0].getBoundingClientRect().top)
        menuUp.style.display = "block";
      } else if (headerPosition[0].getBoundingClientRect().top > -110) {
        menuUp.style.display = "none";
      }

      if (contenedor.getBoundingClientRect().top > 0) {
        menuUp.style.bottom = "10px";
      }
      if (contenedor.getBoundingClientRect().top < 0) {
        menuUp.style.bottom = "110px";
      }
    });
  }
}

function modalListener() {
  const myBody = document.querySelector("body");
  const modal = document.getElementById("modal");
  const abrirMenu = document.getElementById("abrirMenu");
  abrirMenu.addEventListener("click", function (e) {
    modal.style.display = "block";

    myBody.style.position = "fixed";
    myBody.style.width = "100%";
  });

  // Cerrar el modal si pulsan en el (No es su contenido)
  window.addEventListener("click", function (e) {
    if (modal.className == e.target.className) {
      modal.style.display = "none";
      myBody.style.position = "relative";
    }
  });

  // Cerrarlo por su botón
  const btnSalir = document.getElementById("btnSalir");
  btnSalir.addEventListener("click", function (e) {
    modal.style.display = "none";
    myBody.style.position = "relative";
  });
}

function eventListeners() {
 
}
