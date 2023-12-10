// Función para mostrar el alerta
function showAlert() {
  var alertContainer = document.getElementById('alert-container');
  alertContainer.classList.remove('hidden');
  alertContainer.classList.add('show');
}

// Función para cerrar el alerta
function closeAlert() {
  var alertContainer = document.getElementById('alert-container');
  alertContainer.classList.remove('show');
  alertContainer.classList.add('hidden');
}

// Llamamos a showAlert() cuando la página carga (esto es opcional)
document.addEventListener('DOMContentLoaded', showAlert);
