https://prod.liveshare.vsengsaas.visualstudio.com/join?E74ABA57865449E1B088B910A2DDF5D537B0
<!------------------------------------------>
<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "test@localhost";
    $to = "blascooscar36@gmail.com";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";
?>