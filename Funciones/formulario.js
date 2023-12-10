$(document).ready(function () {
    
    function validarFormulario() {
       
        $(".formulario__grupo-input").removeClass("formulario__grupo-input-error");
        $(".formulario__validacion-estado").removeClass("fa-times-circle");

      
        var nombre = $("#nombre").val().trim();
        var apellidos = $("#apellidos").val().trim();
        var correo = $("#correo").val().trim();
        var dni = $("#dni").val().trim();
        var password = $("#password").val();
        var password2 = $("#password2").val();
        var terminos = $("#terminos").is(":checked");

       
        if (nombre === "") {
            mostrarError($("#grupo__nombre"), "Por favor, ingrese su nombre");
        }

     
        if (apellidos === "") {
            mostrarError($("#grupo__apellidos"), "Por favor, ingrese sus apellidos");
        }

      
        if (correo === "" || !validarCorreo(correo)) {
            mostrarError($("#grupo__correo"), "Por favor, ingrese un correo electrónico válido");
        }

       
        if (dni === "" || !validarDNI(dni)) {
            mostrarError($("#grupo__dni"), "Por favor, ingrese un DNI válido");
        }

      
        if (password === "" || password.length < 6) {
            mostrarError($("#grupo__password"), "La contraseña debe tener al menos 6 caracteres");
        }

        if (password2 === "" || password !== password2) {
            mostrarError($("#grupo__password2"), "Las contraseñas no coinciden");
        }

      
        if (!terminos) {
            mostrarError($("#grupo__terminos"), "Debe aceptar los Términos y Condiciones");
        }

        if ($(".formulario__grupo-input-error").length > 0) {
            $("#formulario__mensaje").addClass("formulario__mensaje-activo");
            return false; 
        }

     
        return true;
    }

  
    function mostrarError(elemento, mensaje) {
        elemento.addClass("formulario__grupo-input-error");
        elemento.find(".formulario__validacion-estado").addClass("fa-times-circle");
        elemento.next().text(mensaje);
    }


    function validarCorreo(correo) {
        var expresionCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return expresionCorreo.test(correo);
    }


    function validarDNI(dni) {
        var expresionDNI = /^\d{8}[a-zA-Z]$/;
        return expresionDNI.test(dni);
    }

    $("#formulario").submit(function (event) {
        if (!validarFormulario()) {
            event.preventDefault(); 
        } else {

            $("#formulario__mensaje").addClass("formulario__mensaje-activo");
        }
		setTimeout(function () {
			location.reload();
		}, 3000);
    });


});

