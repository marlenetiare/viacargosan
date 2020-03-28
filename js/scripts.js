$(".contact-btn").click(function() {

    let correctRequest = true;

    $(".error-field").removeClass("error-field");

    $("#contact-form .field").each(function() {
        const field = $(this);
        if (!field.val()) {
            field.parent().addClass('error-field');
        } else if (field.attr('name') == 'email') {
            if (!validateEmail(field.val())) {
                field.parent().addClass('error-field');
            }
        }
    });

    if (correctRequest) {
        const data = $("#contact-form").serializeArray();
        processAjax("http://localhost:8897/viacargosan/ajax/contact.php", data);
    }

    return false;
});

function showErrors(message) {
    $(".result-form").html(message);
    $(".result-form").addClass('error-form'); 
}

function endContact(message) {
    $(".result-form").html(message);
    $(".result-form").addClass('success-form'); 
    $(".result-form").fadeIn();
    $("#contact-form").fadeOut();
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

function processAjax(url,parameters) { 
    $.ajax({
      type: "POST",
      data: parameters,
      url: url,
      dataType: "JSON",
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      processData: true,
      success: function(data) {
        let action = (data.result) ? data.result : '';
        var details = (data.details) ? data.details : '';
        if (action) {
            eval(action+"('"+details+"')");
        }
      }
    });
  }