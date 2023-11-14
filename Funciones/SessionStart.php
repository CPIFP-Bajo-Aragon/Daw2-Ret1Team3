<!--Comprueba que la session esta iniciada-->
  
  <?php
    
    if (!isset($_SESSION['dni'])) {
        header('Location: ../../');
        exit;
    }
    ?>  