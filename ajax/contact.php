<?php 
    
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lenguage = (isset($_POST['lenguage']) ? $_POST['lenguage'] : 'esp');

    $name = null;
    if (isset($_POST['name_eng']) && !empty($_POST['name_eng'])) {
      $name = $_POST['name_eng'];
    } else if (isset($_POST['name_span']) && !empty($_POST['name_span'])) {
      $name = $_POST['name_span'];
    }

    $email = (isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : null);

    $message = null;
    if (isset($_POST['message_eng']) && !empty($_POST['message_eng'])) {
      $message = $_POST['message_eng'];
    } else if (isset($_POST['message_spa']) && !empty($_POST['message_spa'])) {
      $message = $_POST['message_spa'];
    }

    if (!empty($name) && !empty($email) && !empty($message)) {

      $msg = "Tienes un mensaje:\n Nombre: $name \n E-mail: $email \n Mensaje: $message";
      mail("marlene.jamett@gmail.com","Nuevo mensaje desde Cargosan",$msg);

      $message = ($lenguage == 'esp' ? 'Gracias por tu mensaje, pronto nos pondremos en contacto contigo.' : "Thanks for your message. We will be in touch with you soon.");

      $response = array('result' => 'endContact','details' => $message);
      print json_encode($response);
      exit;

    } else {
      $message = ($lenguage == 'esp' ? 'Por favor complete todos los campos antes de continuar.' : "Please, fill all the fields before continue.");
      $response = array('result' => 'showErrors','details' => $message);
      print json_encode($response);
      exit;
    }

  }

?>