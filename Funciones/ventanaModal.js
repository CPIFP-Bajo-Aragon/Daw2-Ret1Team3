/* OPEN MODAL TITULACIÓN */

function openModalTitulacion() {

  var modal = document.createElement('div');
  modal.className = 'modalCreate';

  var modalCard = document.createElement('div');
  modalCard.className = 'modalCard';

  // Titulo Card
  var titulo = document.createElement('h2');
  titulo.textContent = "Agregar titulación";
  modalCard.appendChild(titulo);

  var closeButton = document.createElement('span');
  closeButton.className = 'closeButton';
  closeButton.innerHTML = '&times;';
  closeButton.onclick = closeModal;
  modalCard.appendChild(closeButton);

  var form = document.createElement('form');
  form.className = 'form-container';
  form.method = 'POST';
  form.onsubmit = validarFechas;
  form.action = './Titulaciones/actualizar.php';

  // Centros
  var labelCentros = document.createElement('label');
  labelCentros.htmlFor = 'centros';
  labelCentros.textContent = 'Centro:';
  labelCentros.className = 'asterisco';
  form.appendChild(labelCentros);

  var selectCentros = document.createElement('select');
  selectCentros.name = 'centros';
  selectCentros.id = 'centros';

  // Cargar los centros mediante Fetch

  fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Titulaciones/cargarCentros.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      console.log('Después de fetch');
      console.log('Datos recibidos:', data);
      data.forEach(centro => {
        console.log('Añadiendo centro:', centro);
        var option = document.createElement('option');
        option.value = centro.Id_Centro;
        option.textContent = centro.Nombre_Centro;
        selectCentros.appendChild(option);
      });
    })
    .catch(error => {
      if (error instanceof SyntaxError) {
        console.error('Error: La respuesta del servidor no es un JSON válido.');
      } else {
        console.error('Error en la solicitud Fetch:', error.message, error);
      }
    });



  form.appendChild(selectCentros);

  // Fecha Inicio
  var labelFechaInicio = document.createElement('label');
  labelFechaInicio.htmlFor = 'Fecha_Inicio';
  labelFechaInicio.textContent = 'Fecha_Inicio:';
  labelFechaInicio.className = 'asterisco';
  form.appendChild(labelFechaInicio);

  var inputFechaInicio = document.createElement('input');
  inputFechaInicio.type = 'date';
  inputFechaInicio.name = 'Fecha_Inicio';
  inputFechaInicio.required = true;
  form.appendChild(inputFechaInicio);

  // Fecha Fin
  var labelFechaFin = document.createElement('label');
  labelFechaFin.htmlFor = 'Fecha_Fin';
  labelFechaFin.textContent = 'Fecha_Fin:';
  form.appendChild(labelFechaFin);

  var inputFechaFin = document.createElement('input');
  inputFechaFin.type = 'date';
  inputFechaFin.name = 'Fecha_Fin';
  form.appendChild(inputFechaFin);

  // Titulos
  var labelTitulos = document.createElement('label');
  labelTitulos.htmlFor = 'titulos';
  labelTitulos.textContent = 'Titulo:';
  labelTitulos.className = 'asterisco';
  form.appendChild(labelTitulos);

  var selectTitulos = document.createElement('select');
  selectTitulos.name = 'titulos';
  selectTitulos.id = 'titulos';

  fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Titulaciones/cargarTitulos.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      console.log('Después de fetch');
      console.log('Datos recibidos:', data);
      data.forEach(titulo => {
        console.log('Añadiendo titulo:', titulo);
        var option = document.createElement('option');
        option.value = titulo.Id_Tipo_Titulacion;
        option.textContent = titulo.Tipo + " - " + titulo.Nombre;
        selectTitulos.appendChild(option);
      });
    })
    .catch(error => {
      if (error instanceof SyntaxError) {
        console.error('Error: La respuesta del servidor no es un JSON válido.');
      } else {
        console.error('Error en la solicitud Fetch:', error.message, error);
      }
    });

  form.appendChild(selectTitulos);

  var submitButton = document.createElement('input');
  submitButton.type = 'submit';
  submitButton.value = 'Añadir Titulación';
  form.appendChild(submitButton);

  modalCard.appendChild(form);
  modal.appendChild(modalCard);

  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
  modalContainer.appendChild(modal);

  modal.style.display = 'block';
}



/* OPEN MODAL IDIOMA */

function openModalIdioma() {
  var modal = document.createElement('div');
  modal.className = 'modalCreate';

  var modalCard = document.createElement('div');
  modalCard.className = 'modalCard';

  // Titulo Card
  var titulo = document.createElement('h2');
  titulo.textContent = "Agregar idioma";
  modalCard.appendChild(titulo);

  var closeButton = document.createElement('span');
  closeButton.className = 'closeButton';
  closeButton.innerHTML = '&times;';
  closeButton.onclick = closeModal;
  modalCard.appendChild(closeButton);

  var form = document.createElement('form');
  form.className = 'form-container';
  form.method = 'POST';
  form.onsubmit = validarFechas;
  form.action = './Idioma/añadirIdioma.php';


  // Idioma

  var labelIdiomas = document.createElement('label');
  labelIdiomas.htmlFor = 'idiomas';
  labelIdiomas.textContent = 'Idioma:';
  form.appendChild(labelIdiomas);

  var selectIdiomas = document.createElement('select');
  selectIdiomas.name = 'Idioma';
  selectIdiomas.id = 'Idioma';

  fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Idioma/cargarIdiomas.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      console.log('Después de fetch');
      console.log('Datos recibidos:', data);
      data.forEach(idioma => {
        console.log('Añadiendo idioma:', idioma);
        var option = document.createElement('option');
        option.value = idioma.Id_Idioma;
        option.textContent = idioma.Idioma;
        selectIdiomas.appendChild(option);
      });
    })
    .catch(error => {
      if (error instanceof SyntaxError) {
        console.error('Error: La respuesta del servidor no es un JSON válido.');
      } else {
        console.error('Error en la solicitud Fetch:', error.message, error);
      }
    });

  form.appendChild(selectIdiomas);

  // Niveles

  var labelNiveles = document.createElement('label');
  labelNiveles.htmlFor = 'niveles';
  labelNiveles.textContent = 'nivel:';
  form.appendChild(labelNiveles);

  var selectNiveles = document.createElement('select');
  selectNiveles.name = 'Nivel';
  selectNiveles.id = 'Nivel';

  fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Idioma/cargarNiveles.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      console.log('Después de fetch');
      console.log('Datos recibidos:', data);
      data.forEach(nivel => {
        console.log('Añadiendo nivel:', nivel);
        var option = document.createElement('option');
        option.value = nivel.Id_Nivel;
        option.textContent = nivel.nivel;
        selectNiveles.appendChild(option);
      });
    })
    .catch(error => {
      if (error instanceof SyntaxError) {
        console.error('Error: La respuesta del servidor no es un JSON válido.');
      } else {
        console.error('Error en la solicitud Fetch:', error.message, error);
      }
    });

  form.appendChild(selectNiveles);



  var submitButton = document.createElement('input');
  submitButton.type = 'submit';
  submitButton.value = 'Añadir Formación';
  form.appendChild(submitButton);

  modalCard.appendChild(form);
  modal.appendChild(modalCard);

  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
  modalContainer.appendChild(modal);

  modal.style.display = 'block';
}

/* OPEN MODAL FORMACIÓN*/

function openModalFormacion() {
  var modal = document.createElement('div');
  modal.className = 'modalCreate';

  var modalCard = document.createElement('div');
  modalCard.className = 'modalCard';

  // Titulo Card
  var titulo = document.createElement('h2');
  titulo.textContent = "Agregar formación complementaria";
  modalCard.appendChild(titulo);

  var closeButton = document.createElement('span');
  closeButton.className = 'closeButton';
  closeButton.innerHTML = '&times;';
  closeButton.onclick = closeModal;
  modalCard.appendChild(closeButton);

  var form = document.createElement('form');
  form.className = 'form-container';
  form.method = 'POST';
  form.onsubmit = validarFechas;
  form.action = './Formacion_Complementaria/añadirFormacion.php';

  // Nombre
  var labelNombre = document.createElement('label');
  labelNombre.htmlFor = 'Nombre';
  labelNombre.textContent = 'Nombre:';
  labelNombre.className = 'asterisco';
  form.appendChild(labelNombre);

  var inputNombre = document.createElement('input');
  inputNombre.type = 'text';
  inputNombre.name = 'Nombre';
  inputNombre.required = true;
  form.appendChild(inputNombre);

  // Entidad Emisora
  var labelEntidadEmisora = document.createElement('label');
  labelEntidadEmisora.htmlFor = 'EntidadEmisora';
  labelEntidadEmisora.textContent = 'Entidad Emisora:';
  labelEntidadEmisora.className = 'asterisco';
  form.appendChild(labelEntidadEmisora);

  var inputEntidadEmisora = document.createElement('input');
  inputEntidadEmisora.type = 'text';
  inputEntidadEmisora.name = 'Entidad_Emisora';
  inputEntidadEmisora.required = true;
  form.appendChild(inputEntidadEmisora);

  // Fecha Inicio
  var labelFechaInicio = document.createElement('label');
  labelFechaInicio.htmlFor = 'Fecha_Inicio';
  labelFechaInicio.textContent = 'Fecha inicio:';
  labelFechaInicio.className = 'asterisco';
  form.appendChild(labelFechaInicio);

  var inputFechaInicio = document.createElement('input');
  inputFechaInicio.type = 'date';
  inputFechaInicio.name = 'Fecha_Inicio';
  inputFechaInicio.required = true;
  form.appendChild(inputFechaInicio);

  // Fecha Fin
  var labelFechaFin = document.createElement('label');
  labelFechaFin.htmlFor = 'Fecha_Fin';
  labelFechaFin.textContent = 'Fecha fin:';
  form.appendChild(labelFechaFin);

  var inputFechaFin = document.createElement('input');
  inputFechaFin.type = 'date';
  inputFechaFin.name = 'Fecha_Fin';
  form.appendChild(inputFechaFin);

  // Fecha Caducidad
  var labelFechaCaducidad = document.createElement('label');
  labelFechaCaducidad.htmlFor = 'Fecha_Caducidad';
  labelFechaCaducidad.textContent = 'Fecha caducidad:';
  form.appendChild(labelFechaCaducidad);

  var inputFechaCaducidad = document.createElement('input');
  inputFechaCaducidad.type = 'date';
  inputFechaCaducidad.name = 'Fecha_Caducidad';
  form.appendChild(inputFechaCaducidad);

  // Horas
  var labelNum_Horas = document.createElement('label');
  labelNum_Horas.htmlFor = 'Num_Horas';
  labelNum_Horas.textContent = 'Número de horas:';
  labelNum_Horas.className = 'asterisco';
  form.appendChild(labelNum_Horas);

  var inputNum_Horas = document.createElement('input');
  inputNum_Horas.type = 'text';
  inputNum_Horas.name = 'Num_Horas';
  inputNum_Horas.required = true;
  inputNum_Horas.pattern = '[0-9]+';
  form.appendChild(inputNum_Horas);

  // Descripcion
  var labelDescripcion = document.createElement('label');
  labelDescripcion.htmlFor = 'Descripcion';
  labelDescripcion.textContent = 'Descripción:';
  labelDescripcion.className = 'asterisco';
  form.appendChild(labelDescripcion);

  var inputDescripcion = document.createElement('textarea');
  inputDescripcion.name = 'Descripcion';
  inputDescripcion.required = true;
  form.appendChild(inputDescripcion);




  var submitButton = document.createElement('input');
  submitButton.type = 'submit';
  submitButton.value = 'Añadir formación';
  form.appendChild(submitButton);

  modalCard.appendChild(form);
  modal.appendChild(modalCard);

  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
  modalContainer.appendChild(modal);

  modal.style.display = 'block';
}


/* OPEN MODAL FORMACIÓN BOTÓN EDITAR*/

function openModalFormacionEditar(Id_Formacion_Complementaria) {

  var modal = document.createElement('div');
  modal.className = 'modalCreate';

  var modalCard = document.createElement('div');
  modalCard.className = 'modalCard';

  // Titulo Card
  var titulo = document.createElement('h2');
  titulo.textContent = "Editar formación complementaria";
  modalCard.appendChild(titulo);

  var closeButton = document.createElement('span');
  closeButton.className = 'closeButton';
  closeButton.innerHTML = '&times;';
  closeButton.onclick = closeModal;
  modalCard.appendChild(closeButton);

  var form = document.createElement('form');
  form.className = 'form-container';
  form.method = 'POST';
  form.onsubmit = validarFechas;
  form.action = './Formacion_Complementaria/editarFormacion.php';

  // Id_Formacion_Complementaria

  var inputFormacionComplementaria = document.createElement('input');
  inputFormacionComplementaria.type = 'hidden';
  inputFormacionComplementaria.name = 'Id_Formacion_Complementaria';
  inputFormacionComplementaria.value = Id_Formacion_Complementaria;
  form.appendChild(inputFormacionComplementaria);

  // Nombre

  var labelNombre = document.createElement('label');
  labelNombre.htmlFor = 'nombre';
  labelNombre.textContent = 'Nombre:';


  var inputNombre = document.createElement('input');
  inputNombre.type = 'text';
  inputNombre.name = 'nombre';
  inputNombre.required = true;

  // Entidad Emisora

  var labelEntidadEmisora = document.createElement('label');
  labelEntidadEmisora.htmlFor = 'EntidadEmisora';
  labelEntidadEmisora.textContent = 'Entidad Emisora:';


  var inputEntidadEmisora = document.createElement('input');
  inputEntidadEmisora.type = 'text';
  inputEntidadEmisora.name = 'Entidad_Emisora';
  inputEntidadEmisora.required = true;

  // Fecha Inicio
  var labelFechaInicio = document.createElement('label');
  labelFechaInicio.htmlFor = 'Fecha_Inicio';
  labelFechaInicio.textContent = 'Fecha inicio:';


  var inputFechaInicio = document.createElement('input');
  inputFechaInicio.type = 'date';
  inputFechaInicio.name = 'Fecha_Inicio';
  inputFechaInicio.required = true;

  // Fecha Fin
  var labelFechaFin = document.createElement('label');
  labelFechaFin.htmlFor = 'Fecha_Fin';
  labelFechaFin.textContent = 'Fecha fin:';
  form.appendChild(labelFechaFin);

  var inputFechaFin = document.createElement('input');
  inputFechaFin.type = 'date';
  inputFechaFin.name = 'Fecha_Fin';

  // Fecha Caducidad
  var labelFechaCaducidad = document.createElement('label');
  labelFechaCaducidad.htmlFor = 'Fecha_Caducidad';
  labelFechaCaducidad.textContent = 'Fecha caducidad:';


  var inputFechaCaducidad = document.createElement('input');
  inputFechaCaducidad.type = 'date';
  inputFechaCaducidad.name = 'Fecha_Caducidad';

  // Horas
  var labelNum_Horas = document.createElement('label');
  labelNum_Horas.htmlFor = 'Num_Horas';
  labelNum_Horas.textContent = 'Número de horas:';


  var inputNum_Horas = document.createElement('input');
  inputNum_Horas.type = 'text';
  inputNum_Horas.name = 'Num_Horas';
  inputNum_Horas.required = true;
  inputNum_Horas.pattern = '[0-9]+';

  // Descripcion
  var labelDescripcion = document.createElement('label');
  labelDescripcion.htmlFor = 'Descripcion';
  labelDescripcion.textContent = 'Descripción:';


  var inputDescripcion = document.createElement('textarea');
  inputDescripcion.name = 'Descripcion';
  inputDescripcion.required = true;



  fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Formacion_Complementaria/verFormacionModal.php?Id_Formacion_Complementaria=' + Id_Formacion_Complementaria)
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      console.log('Después de fetch');
      console.log('Datos recibidos:', data);
      data.forEach(formacion => {
        console.log('Añadiendo nombre:', formacion);
        inputNombre.value = formacion.Nombre;
        inputEntidadEmisora.value = formacion.Entidad_Emisora;
        inputFechaInicio.value = formacion.Fecha_Inicio;
        inputFechaFin.value = formacion.Fecha_Fin;
        inputFechaCaducidad.value = formacion.Fecha_Caducidad;
        inputNum_Horas.value = formacion.Num_Horas;
        inputDescripcion.value = formacion.Descripcion;
      });
    })
    .catch(error => {
      if (error instanceof SyntaxError) {
        console.error('Error: La respuesta del servidor no es un JSON válido.');
      } else {
        console.error('Error en la solicitud Fetch:', error.message, error);
      }
    });
  form.appendChild(labelNombre);
  form.appendChild(inputNombre);
  form.appendChild(labelEntidadEmisora);
  form.appendChild(inputEntidadEmisora);
  form.appendChild(labelFechaInicio);
  form.appendChild(inputFechaInicio);
  form.appendChild(labelFechaFin);
  form.appendChild(inputFechaFin);
  form.appendChild(labelFechaCaducidad);
  form.appendChild(inputFechaCaducidad);
  form.appendChild(labelNum_Horas);
  form.appendChild(inputNum_Horas);
  form.appendChild(labelDescripcion);
  form.appendChild(inputDescripcion);




  var submitButton = document.createElement('input');
  submitButton.type = 'submit';
  submitButton.value = 'Editar formación';
  form.appendChild(submitButton);

  modalCard.appendChild(form);
  modal.appendChild(modalCard);

  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
  modalContainer.appendChild(modal);

  modal.style.display = 'block';
}


// /* OPEN MODAL HABILIDADES BÁSICAS(hard) */

// function openModalHabilidadesBasicas() {
//   var modal = document.createElement('div');
//   modal.className = 'modalCreate';

//   var modalCard = document.createElement('div');
//   modalCard.className = 'modalCard';

//   // Titulo Card
//   var titulo = document.createElement('h2');
//   titulo.textContent = "Agregar habilidades básicas";
//   modalCard.appendChild(titulo);

//   var closeButton = document.createElement('span');
//   closeButton.className = 'closeButton';
//   closeButton.innerHTML = '&times;';
//   closeButton.onclick = closeModal;
//   modalCard.appendChild(closeButton);

//   var form = document.createElement('form');
//   form.className = 'form-container';
//   form.method = 'POST';
//   form.onsubmit = validarFechas;
//   form.action = './Habilidades_basicas/guardar_habilidades.php';


//   // Habilidades básicas

//   var labelHabilidadesBasicas = document.createElement('label');
//   labelHabilidadesBasicas.htmlFor = 'habilidadesBasicas';
//   labelHabilidadesBasicas.textContent = 'Habilidades básicas:';
//   form.appendChild(labelHabilidadesBasicas);

//   var selectHabilidadesBasicas = document.createElement('select');
//   selectHabilidadesBasicas.name = 'habilidadesBasicas';
//   selectHabilidadesBasicas.id = 'habilidadesBasicas';

//   fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Habilidades_basicas/cargar_habilidades_basicas.php')
//     .then(response => {
//       if (!response.ok) {
//         throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
//       }
//       return response.json();
//     })
//     .then(data => {
//       console.log('Después de fetch');
//       console.log('Datos recibidos:', data);
//       data.forEach(habilidadesBasicas => {
//         console.log('Añadiendo habilidades básicas:', habilidadesBasicas);
//         var option = document.createElement('option');
//         option.value = habilidadesBasicas.Id_Hard;
//         option.textContent = habilidadesBasicas.nombre;
//         selectHabilidadesBasicas.appendChild(option);
//       });
//     })
//     .catch(error => {
//       if (error instanceof SyntaxError) {
//         console.error('Error: La respuesta del servidor no es un JSON válido.');
//       } else {
//         console.error('Error en la solicitud Fetch:', error.message, error);
//       }
//     });

//   form.appendChild(selectHabilidadesBasicas);




//   var submitButton = document.createElement('input');
//   submitButton.type = 'submit';
//   submitButton.value = 'Añadir habilidades básicas';
//   form.appendChild(submitButton);

//   modalCard.appendChild(form);
//   modal.appendChild(modalCard);

//   var modalContainer = document.getElementById('modal-container');
//   modalContainer.innerHTML = '';
//   modalContainer.appendChild(modal);

//   modal.style.display = 'block';
// }



// /* OPEN MODAL HABILIDADES personales(soft) */

// function openModalHabilidadesPersonales() {
//   var modal = document.createElement('div');
//   modal.className = 'modalCreate';

//   var modalCard = document.createElement('div');
//   modalCard.className = 'modalCard';

//   // Titulo Card
//   var titulo = document.createElement('h2');
//   titulo.textContent = "Agregar habilidades personales";
//   modalCard.appendChild(titulo);

//   var closeButton = document.createElement('span');
//   closeButton.className = 'closeButton';
//   closeButton.innerHTML = '&times;';
//   closeButton.onclick = closeModal;
//   modalCard.appendChild(closeButton);

//   var form = document.createElement('form');
//   form.className = 'form-container';
//   form.method = 'POST';
//   form.onsubmit = validarFechas;
//   form.action = './Habilidades_personales/guardar_habilidades.php';


//   // Habilidades personales

//   var labelHabilidadesPersonales = document.createElement('label');
//   labelHabilidadesPersonales.htmlFor = 'habilidadesPersonales';
//   labelHabilidadesPersonales.textContent = 'Habilidades personales:';
//   form.appendChild(labelHabilidadesPersonales);

//   var selectHabilidadesPersonales = document.createElement('select');
//   selectHabilidadesPersonales.name = 'habilidadesPersonales';
//   selectHabilidadesPersonales.id = 'habilidadesPersonales';

//   fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Habilidades_personales/cargar_habilidades_personales.php')
//     .then(response => {
//       if (!response.ok) {
//         throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
//       }
//       return response.json();
//     })
//     .then(data => {
//       console.log('Después de fetch');
//       console.log('Datos recibidos:', data);
//       data.forEach(habilidadesPersonales => {
//         console.log('Añadiendo habilidades personales:', habilidadesPersonales);
//         var option = document.createElement('option');
//         option.value = habilidadesPersonales.Id_Soft;
//         option.textContent = habilidadesPersonales.nombre;
//         selectHabilidadesPersonales.appendChild(option);
//       });
//     })
//     .catch(error => {
//       if (error instanceof SyntaxError) {
//         console.error('Error: La respuesta del servidor no es un JSON válido.');
//       } else {
//         console.error('Error en la solicitud Fetch:', error.message, error);
//       }
//     });

//   form.appendChild(selectHabilidadesPersonales);




//   var submitButton = document.createElement('input');
//   submitButton.type = 'submit';
//   submitButton.value = 'Añadir habilidades personales';
//   form.appendChild(submitButton);

//   modalCard.appendChild(form);
//   modal.appendChild(modalCard);

//   var modalContainer = document.getElementById('modal-container');
//   modalContainer.innerHTML = '';
//   modalContainer.appendChild(modal);

//   modal.style.display = 'block';
// }

/* OPEN MODAL EXPERIENCIA*/

function openModalExperiencia() {
  var modal = document.createElement('div');
  modal.className = 'modalCreate';

  var modalCard = document.createElement('div');
  modalCard.className = 'modalCard';

  // Titulo Card
  var titulo = document.createElement('h2');
  titulo.textContent = "Agregar experiencia laboral";
  modalCard.appendChild(titulo);

  var closeButton = document.createElement('span');
  closeButton.className = 'closeButton';
  closeButton.innerHTML = '&times;';
  closeButton.onclick = closeModal;
  modalCard.appendChild(closeButton);

  var form = document.createElement('form');
  form.className = 'form-container';
  form.method = 'POST';
  form.onsubmit = validarFechas;
  form.action = './Experiencia_Laboral/insertarexplab.php';

  // Nombre Empresa
  var labelNombre = document.createElement('label');
  labelNombre.htmlFor = 'Nombre';
  labelNombre.textContent = 'Nombre:';
  labelNombre.className = 'asterisco';
  form.appendChild(labelNombre);

  var inputNombre = document.createElement('input');
  inputNombre.type = 'text';
  inputNombre.name = 'Nombre';
  inputNombre.required = true;
  form.appendChild(inputNombre);

  // Puesto
  var labelPuesto = document.createElement('label');
  labelPuesto.htmlFor = 'Puesto';
  labelPuesto.textContent = 'Puesto:';
  labelPuesto.className = 'asterisco';
  form.appendChild(labelPuesto);

  var inputPuesto = document.createElement('input');
  inputPuesto.type = 'text';
  inputPuesto.name = 'Puesto';
  inputPuesto.required = true;
  form.appendChild(inputPuesto);

  // Fecha Inicio
  var labelFechaInicio = document.createElement('label');
  labelFechaInicio.htmlFor = 'Fecha_Inicio';
  labelFechaInicio.textContent = 'Fecha inicio:';
  labelFechaInicio.className = 'asterisco';
  form.appendChild(labelFechaInicio);

  var inputFechaInicio = document.createElement('input');
  inputFechaInicio.type = 'date';
  inputFechaInicio.name = 'Fecha_Inicio';
  inputFechaInicio.required = true;
  form.appendChild(inputFechaInicio);

  // Fecha Fin
  var labelFechaFin = document.createElement('label');
  labelFechaFin.htmlFor = 'Fecha_Fin';
  labelFechaFin.textContent = 'Fecha fin:';
  form.appendChild(labelFechaFin);

  var inputFechaFin = document.createElement('input');
  inputFechaFin.type = 'date';
  inputFechaFin.name = 'Fecha_Fin';
  form.appendChild(inputFechaFin);

  // Descripcion
  var labelDescripcion = document.createElement('label');
  labelDescripcion.htmlFor = 'Descripcion';
  labelDescripcion.textContent = 'Descripción:';
  labelDescripcion.className = 'asterisco';
  form.appendChild(labelDescripcion);

  var inputDescripcion = document.createElement('textarea');
  inputDescripcion.name = 'Descripcion';
  inputDescripcion.required = true;
  form.appendChild(inputDescripcion);





  var submitButton = document.createElement('input');
  submitButton.type = 'submit';
  submitButton.value = 'Añadir experiencia laboral';
  form.appendChild(submitButton);

  modalCard.appendChild(form);
  modal.appendChild(modalCard);

  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
  modalContainer.appendChild(modal);

  modal.style.display = 'block';
}



/* OPEN MODAL EXPERIENCIA BOTÓN EDITAR*/

function openModalExperienciaEditar(Id_Experiencia_Laboral) {

  var modal = document.createElement('div');
  modal.className = 'modalCreate';

  var modalCard = document.createElement('div');
  modalCard.className = 'modalCard';

  // Titulo Card
  var titulo = document.createElement('h2');
  titulo.textContent = "Editar experiencia laboral";
  modalCard.appendChild(titulo);

  var closeButton = document.createElement('span');
  closeButton.className = 'closeButton';
  closeButton.innerHTML = '&times;';
  closeButton.onclick = closeModal;
  modalCard.appendChild(closeButton);

  var form = document.createElement('form');
  form.className = 'form-container';
  form.method = 'POST';
  form.onsubmit = validarFechas;
  form.action = './Experiencia_Laboral/editar.php';

  // Id_Experiencia_Laboral

  var inputExperienciaLaboral = document.createElement('input');
  inputExperienciaLaboral.type = 'hidden';
  inputExperienciaLaboral.name = 'Id_Experiencia_Laboral';
  inputExperienciaLaboral.value = Id_Experiencia_Laboral;
  form.appendChild(inputExperienciaLaboral);

  // Nombre

  var labelNombre = document.createElement('label');
  labelNombre.htmlFor = 'nombre';
  labelNombre.textContent = 'Nombre:';


  var inputNombre = document.createElement('input');
  inputNombre.type = 'text';
  inputNombre.name = 'nombre';
  inputNombre.required = true;

  // Puesto

  var labelPuesto = document.createElement('label');
  labelPuesto.htmlFor = 'Puesto';
  labelPuesto.textContent = 'Puesto:';


  var inputPuesto = document.createElement('input');
  inputPuesto.type = 'text';
  inputPuesto.name = 'Puesto';
  inputPuesto.required = true;

  // Fecha Inicio
  var labelFechaInicio = document.createElement('label');
  labelFechaInicio.htmlFor = 'Fecha_Inicio';
  labelFechaInicio.textContent = 'Fecha inicio:';


  var inputFechaInicio = document.createElement('input');
  inputFechaInicio.type = 'date';
  inputFechaInicio.name = 'Fecha_Inicio';
  inputFechaInicio.required = true;

  // Fecha Fin
  var labelFechaFin = document.createElement('label');
  labelFechaFin.htmlFor = 'Fecha_Fin';
  labelFechaFin.textContent = 'Fecha fin:';
  form.appendChild(labelFechaFin);

  var inputFechaFin = document.createElement('input');
  inputFechaFin.type = 'date';
  inputFechaFin.name = 'Fecha_Fin';

  // Descripcion
  var labelDescripcion = document.createElement('label');
  labelDescripcion.htmlFor = 'Descripcion';
  labelDescripcion.textContent = 'Descripción:';


  var inputDescripcion = document.createElement('textarea');
  inputDescripcion.name = 'Descripcion';
  inputDescripcion.required = true;



  fetch('https://192.168.4.246/Inicio/Inicio_Alumno/Experiencia_Laboral/verExperienciaLaboralModal.php?Id_Experiencia_Laboral=' + Id_Experiencia_Laboral)
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la solicitud Fetch. Estado de respuesta: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      console.log('Después de fetch');
      console.log('Datos recibidos:', data);
      data.forEach(experienciaLaboral => {
        console.log('Añadiendo nombre:', experienciaLaboral);
        inputNombre.value = experienciaLaboral.Nombre_Empresa;
        inputPuesto.value = experienciaLaboral.Puesto;
        inputFechaInicio.value = experienciaLaboral.Fecha_Inicio;
        inputFechaFin.value = experienciaLaboral.Fecha_Fin;
        inputDescripcion.value = experienciaLaboral.Descripcion;
      });
    })
    .catch(error => {
      if (error instanceof SyntaxError) {
        console.error('Error: La respuesta del servidor no es un JSON válido.');
      } else {
        console.error('Error en la solicitud Fetch:', error.message, error);
      }
    });
  form.appendChild(labelNombre);
  form.appendChild(inputNombre);
  form.appendChild(labelPuesto);
  form.appendChild(inputPuesto);
  form.appendChild(labelFechaInicio);
  form.appendChild(inputFechaInicio);
  form.appendChild(labelFechaFin);
  form.appendChild(inputFechaFin);
  form.appendChild(labelDescripcion);
  form.appendChild(inputDescripcion);




  var submitButton = document.createElement('input');
  submitButton.type = 'submit';
  submitButton.value = 'Editar experiencia laboral';
  form.appendChild(submitButton);

  modalCard.appendChild(form);
  modal.appendChild(modalCard);

  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
  modalContainer.appendChild(modal);

  modal.style.display = 'block';
}










// VALIDAR, CERRAR, ETC...

function closeModal() {
  var modalContainer = document.getElementById('modal-container');
  modalContainer.innerHTML = '';
}

function validarFechas() {
  var fechaInicio = new Date(document.getElementsByName("Fecha_Inicio")[0].value);
  var fechaFin = new Date(document.getElementsByName("Fecha_Fin")[0].value);

  if (fechaFin <= fechaInicio) {
    alert("La Fecha de Fin debe ser posterior a la Fecha de Inicio.");
    return false;
  }
  return true;
}
