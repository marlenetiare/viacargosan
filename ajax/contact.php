<?php 
    
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lenguage = (isset($_POST['lenguage']) ? $_POST['lenguage'] : 'esp');

    $name = (isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : null);
    $email = (isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : null);
    $message = (isset($_POST['message']) && !empty($_POST['message']) ? $_POST['message'] : null);


    if (!empty($name) && !empty($email) && !empty($message)) {

      $msg = "Tienes un mensaje:\n Nombre: $name \n E-mail: $email \n Mensaje: $message";
      mail("marlene.jamett@gmail.com","Nuevo mensaje desde Via Cargosan",$msg);

      $messageResponse = "Gracias por tu mensaje, pronto nos pondremos en contacto contigo.";

      $response = array('result' => 'endContact','details' => $messageResponse);
      print json_encode($response);
      exit;

    } else {
      $message = 'Por favor complete todos los campos antes de continuar.';
      $response = array('result' => 'showErrors','details' => $message);
      print json_encode($response);
      exit;
    }

  }

?>