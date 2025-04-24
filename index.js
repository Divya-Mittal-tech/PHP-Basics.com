$(document).ready(function () {
  let nameRegex = /^[A-Za-z]+$/; // only alphabets

  // Validate First Name on input
  $('#fname').on('input', function () {
    validateName($(this));
    updateFullNameIfValid();
  });

  // Validate Last Name on input
  $('#lname').on('input', function () {
    validateName($(this));
    updateFullNameIfValid();
  });

  // Function to validate and show error
  function validateName(input) {
    let value = input.val().trim();
    if (value === '') {
      input.next('.error').text('* Required');
    } else if (!nameRegex.test(value)) {
      input.next('.error').text('* Only alphabets allowed');
    } else {
      input.next('.error').text('');
    }
  }

  // Function to autofill full name only if both are valid
  function updateFullNameIfValid() {
    let fname = $('#fname').val().trim();
    let lname = $('#lname').val().trim();

    let fnameValid = nameRegex.test(fname);
    let lnameValid = nameRegex.test(lname);

    if (fnameValid && lnameValid) {
      $('#fullname').val(fname + ' ' + lname);
    } else {
      $('#fullname').val('');
    }
  }

  
});
