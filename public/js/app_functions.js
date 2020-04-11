// Takes a string of a password and returns "true" when it is valid, and an error message when it is not.
function verifyPasswordReqs(pwString){
  var valid = true;
  if (/[!@#$%^&*()\-_\=\+]/.test(pwString) == false){
    valid = "Password must contain one of the symbols: !@#$%^&*()-_=+";
  }
  if (/\d/.test(pwString) == false){
    valid = "Password must contain a number";
  }
  if (/[a-z]/.test(pwString) == false){
    valid = "Password must contain a lowercase character";
  }
  if (/[A-Z]/.test(pwString) == false){
    valid = "Password must contain an uppercase character";
  }
  if (pwString.length < 8 || pwString.length > 16){
    valid = "Password must be between 8 and 16 characters";
  }
  return valid;
}

// Displays the success or failure notification at the top of the page.
function displayNotification(notification_type = "error", error_message, fade_time = false){
  if (notification_type == "error"){
    var notif_elem = "error-display";
  }
  else{
    var notif_elem = "success-display";
  }

  if ($.type(error_message) == "string"){
    $("#" + notif_elem + " .error-display-box span").text(error_message);
  }
  else{ //Handle multiple errors passed as an object
    $("#" + notif_elem + " .error-display-box span").text(""); //Clear out in case of multiple appends
    $.each(error_message, function(index, value){
      $("#" + notif_elem + " .error-display-box span").append('<strong>' + index + '</strong>: ' + value + '<br>');
    });
  }

  if ( fade_time && $.isNumeric(fade_time) ){
    $("#" + notif_elem).show().delay( fade_time );
    $("#" + notif_elem).fadeOut();
  }
  else{
    $("#" + notif_elem).show();
  }
}

function copyToClipboard(copy_text){
  var container = document.querySelector("body");
  var textarea = document.createElement("textarea");
  textarea.style.position = "fixed";
  textarea.style.opacity = "0";
  container.insertBefore(textarea, container.firstChild);
  textarea.value = copy_text;
  textarea.focus();
  textarea.select();
  document.execCommand("copy");
  container.removeChild(textarea);
}
