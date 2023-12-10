document.addEventListener('DOMContentLoaded', function () {
    var paisSelect = document.getElementById('Pais');
    var municipiosSelect = document.getElementById('municipios');

    paisSelect.addEventListener('change', function () {
        var idPais = paisSelect.value;

        if (idPais == 73) {
            fetch('cargarMunicipios.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_pais=' + idPais,
            })
            .then(response => response.text())
            .then(data => {
                municipiosSelect.innerHTML = data;
            })
            .catch(error => {
                console.error('Error en la solicitud fetch:', error);
            });
        } else {
            // Limpiar el select si el país NO es España
            municipiosSelect.innerHTML = '';
        }
    });
});
