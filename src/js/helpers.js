class Ajax {
  estadosPosibles = [
    "No inicializado",
    "Cargando",
    "Cargado",
    "Interactivo",
    "Completado",
  ];

  READY_STATE_UNINITIALIZED = 0;
  READY_STATE_LOADING = 1;
  READY_STATE_LOADED = 2;
  READY_STATE_INTERACTIVE = 3;
  READY_STATE_COMPLETE = 4;

  /**
   * Función para peticiones AJAX
   * @param {*} url Dirección del recurso
   * @param {*} funcion Función muestraContenido como norma general. (Podemos mandar la respuesta a otra funcion)
   * @param {*} funcionError Hay una función por defecto pero podemos poner otra.
   * @param {*} metodo Metodo POST o GET
   * @param {*} parametros Parametros que se enviaran para el metodo post.
   * @param {*} contentType Cabecera content-type necesaria para el método Post
   */
  CargadorContenidos = function (
    url,
    funcion,
    funcionError,
    metodo,
    parametros,
    contentType
  ) {
    this.url = url;
    this.req = null;
    this.onload = funcion;
    this.onerror = funcionError ? funcionError : this.defaultError;
    this.cargaContenidoXML(url, metodo, parametros, contentType);
  };

  cargaContenidoXML = function (url, metodo, parametros, contentType) {
    if (window.XMLHttpRequest) {
      this.req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
      this.req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (this.req) {
      try {
        var loader = this;
        this.req.onreadystatechange = function () {
          loader.onReadyState.call(loader);
        };
        this.req.open(metodo, url, true);
        if (contentType) {
          this.req.setRequestHeader("Content-Type", contentType);
        }
        this.req.send(parametros);
      } catch (err) {
        this.onerror.call(this);
      }
    }
  };

  onReadyState = function () {
    var req = this.req;
    var ready = req.readyState;
    if (ready == this.READY_STATE_COMPLETE) {
      /* document.getElementById("cabezeras").innerHTML +=
          this.req.getAllResponseHeaders();*/
      var httpStatus = req.status;
      if (httpStatus == 200 || httpStatus == 0) {
        this.onload.call(this);
        // console.log(this.req.responseText);
      } else {
        this.onerror.call(this);
      }
    }
  };

  defaultError = function () {
    alert(
      "Se ha producido un error al obtener los datos" +
        "\n\nreadyState:" +
        this.req.readyState +
        "\nstatus: " +
        this.req.status +
        "\nheaders: " +
        this.req.getAllResponseHeaders()
    );
  };
}

