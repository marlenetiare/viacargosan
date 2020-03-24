<div id="systemMessage"></div>
<form class="" action="" id="contactForm">
  <input type="hidden" name="lenguage" id="lenguage-active" value="esp">
  <div class="spanish active">
    <div class="input-form flex">
      <img src="/img/user.png" class="icon" alt="Nombre">
      <input type="text" name="name_span" placeholder="Nombre">
    </div>    
  </div>
  <div class="english">
    <div class="input-form flex">
      <img src="/img/user.png" class="icon" alt="Name">
      <input name="name_eng" type="text" placeholder="Name">
    </div>    
  </div>

  <div class="input-form flex">
    <img src="/img/sobre.png" class="icon" alt="Email Address">
    <input type="text" name="email" placeholder="Email Address">
  </div>

  <div class="spanish active">
      <div class="input-form flex">
        <img src="/img/editar.png" class="icon" alt="email">
        <textarea name="message_spa" id="" cols="10" rows="8" placeholder="Mensaje"></textarea>
      </div>
  </div>
  <div class="english">
      <div class="input-form flex">
        <img src="/img/editar.png" class="icon" alt="message">
        <textarea name="message_eng" id="" cols="10" rows="8" placeholder="Message"></textarea>
      </div>    
  </div>  

  <button class="button" onclick="return processForm();">enviar mensaje</button>

</form>

<script>

  function showErrors(message) {

    $("#systemMessage").html(message);
    $("#contactForm input").each(function() {
      if ($(this).attr('type') == 'text' && !$(this).val()) {
        $(this).addClass('required-field');
      }
    });    

  }

  function endContact(message) {
    $("#systemMessage").html(message);
    $("#contactForm").trigger('reset');
  }
  
  function processForm() {
    const formData = $("#contactForm").serializeArray();
    processAjax('/ajax/contact.php',formData);
    return false;
  }

  function processAjax(url,parameters) {
    hideAlerts();
    $.ajax({
      type: "POST",
      data: parameters,
      url: url,
      dataType: "JSON",
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      processData: true,
      success: function(data) {
        var action  = (data.result)  ? data.result  : '';
        var details = (data.details) ? data.details : '';
        if (action) {
          eval(action+'(details)');
        }
      }
    });
  }

  function hideAlerts() {
    $('.error-message').hide();
    $(".validate").removeClass('validate');
  }
</script>
