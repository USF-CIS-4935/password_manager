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
