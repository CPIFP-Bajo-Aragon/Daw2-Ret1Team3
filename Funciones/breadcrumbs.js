    /* JS BREADCRUMB LISTA */

    document.addEventListener("DOMContentLoaded", function () {
        var breadcrumbs = document.querySelector(".breadcrumbs");
        var dropdown = document.querySelector(".breadcrumb-dropdown");
        dropdown.style.display = "none";
        breadcrumbs.addEventListener("click", function () {
            dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
            breadcrumbs.classList.toggle("open", dropdown.style.display === "block");
        });

        // Cerrar la lista desplegable si se hace clic fuera de ella
        document.addEventListener("click", function (event) {
            if (!breadcrumbs.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = "none";
                breadcrumbs.classList.remove("open");
            }
        });

        // Manejar clic en enlaces del menú
        document.querySelectorAll(".breadcrumb-dropdown a").forEach(function (link) {
            dropdown.style.display = "none";
            breadcrumbs.classList.remove("open");
            link.addEventListener("click", function (event) {
                event.preventDefault(); // Evita la navegación normal
                var targetId = link.getAttribute("href").substring(1); // Elimina el "#" del href
                scrollToSection(targetId);
                // Cierra el menú después de hacer clic en un enlace
                
                
            });
        });

        // Función para desplazarse a la sección
        function scrollToSection(sectionId) {
            var targetSection = document.getElementById(sectionId);
            if (targetSection) {
                var offset = breadcrumbs.clientHeight + 70; // Ajusta el valor según tus necesidades
                window.scrollTo({
                    top: targetSection.offsetTop - offset,
                    behavior: "smooth"
                });
            }
        }
    });