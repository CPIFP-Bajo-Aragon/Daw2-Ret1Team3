  document.addEventListener('DOMContentLoaded', function () {
    var hamburguesa = document.getElementById('hamburguesa');
    var mainMenu = document.querySelector('.main-menu');

    hamburguesa.addEventListener('click', function () {
      mainMenu.style.display = mainMenu.style.display === 'flex' ? 'none' : 'flex';
    });
  });
