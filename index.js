$(document).ready(function() {
  $('#fname, #lname').on("input", function() {
    var fname = $('#fname').val().trim(); 
    var lname = $('#lname').val().trim(); 
    $('#fullname').val(fname + " " + lname);
  });
});