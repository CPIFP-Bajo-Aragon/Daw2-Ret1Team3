<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Alumno</title>
    <link rel="stylesheet" href="Estilos/inicio.css">
</head>

<body>
  
    <main>
    
    <?php include "./Header/inicioCabecera.php"; ?>

        <div class="separador">
            <h4>Objetivo</h4>
            <p>Profitech es una plataforma para poner en contacto a empresas y estudiantes.
                Su objetivo es la inserción laboral del alumnado que se ha formado en los Centros públicos de Formación
                Profesional.</p>
        </div>
        <div class="infoPanel">
            <div class="infoPanelIzq">
                <img src="Imagenes/cheese.png" alt="Imagen Cheese">
                <div>
                    <p>4095 estudiantes</p>
                    <p>1244 ofertas</p>
                    <p>933 empresas</p>
                    <p>51 centros</p>
                </div>
            </div>
            <div class="infoPanelDer">
                <img src="Imagenes/officeInicio.jpg" alt="Imagen Cheese">
            </div>
        </div>
        <div id="inicioInfoPanel">
  <h1>¡Bienvenido a Profitech!</h1>
  <p>En Profitech, estamos comprometidos con conectar el talento estudiantil con las mejores oportunidades profesionales. Somos tu socio confiable en la búsqueda y gestión de ofertas laborales, brindando una plataforma única que facilita el proceso de publicación, visualización e inscripción en las ofertas de empleo.</p>

  <h2>¿Qué hacemos?</h2>
  <p>Nuestra misión es simple: simplificar el camino hacia tu futuro profesional. Trabajamos incansablemente para:</p>
  <ul>
    <li>Facilitar la Publicación de Ofertas: Las empresas confían en nosotros para llegar a estudiantes talentosos. Publicar ofertas laborales en Profitech es rápido y sencillo, lo que significa que puedes llegar a los candidatos adecuados de manera eficiente.</li>
    <li>Maximizar la Visibilidad: Los estudiantes confían en Profitech para acceder a las últimas oportunidades profesionales. Nuestra plataforma garantiza que tus ofertas sean vistas por un público relevante y diverso.</li>
    <li>Simplificar la Inscripción: Hacemos que el proceso de inscripción sea fluido y sin complicaciones. Los estudiantes pueden postularse a las ofertas con solo unos pocos clics, lo que acelera la selección y contratación.</li>
    <li>Brindar Apoyo Personalizado: Nuestro equipo está aquí para ayudarte en cada paso del camino. Desde la creación de ofertas efectivas hasta la gestión de candidatos, estamos comprometidos en brindar el mejor servicio.</li>
  </ul>

  <h2>¿Por qué Profitech?</h2>
  <p>Profitech es la elección obvia para empresas y estudiantes por muchas razones:</p>
  <ul>
    <li>Experiencia y Confianza: Con años de experiencia en la industria, somos líderes en la gestión de oportunidades profesionales para estudiantes.</li>
    <li>Amplia Red de Estudiantes: Nuestra plataforma atrae a una amplia y diversa base de estudiantes talentosos, lo que te permite acceder a candidatos excepcionales.</li>
    <li>Facilidad de Uso: Nuestra plataforma es intuitiva y fácil de navegar, lo que ahorra tiempo y esfuerzo tanto a empresas como a estudiantes.</li>
    <li>Atención Personalizada: Estamos comprometidos en brindar un servicio personalizado para satisfacer tus necesidades específicas.</li>
  </ul>

  <p>En Profitech, sabemos que el futuro profesional comienza aquí. Ya sea que estés buscando talento emergente o una oportunidad para avanzar en tu carrera, estamos aquí para ayudarte a alcanzar tus objetivos.</p>
  <p>¡Únete a nosotros y comienza a dar forma a tu futuro hoy mismo!</p>
</div>





    </main>
    <footer>
        <?php include "Footer/footer.php"; ?>
    </footer>
</body>

</html>
<script>
    const elements = document.querySelectorAll('.scroll-animation');

const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate');
      observer.unobserve(entry.target);
    }
  });
});

elements.forEach((element) => {
  observer.observe(element);
});

