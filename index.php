<!-- Form which user fills -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task-1</title>
</head>
<body>
  <h1>Fill the form</h1>
  <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <label for="fname">First Name: </label>
    <input type="text" name="fname" id="fname">
    <span class="error" style="color: red">* Required</span>
    <br></br>
    <label for="lname">Last Name: </label>
    <input type="text" name="lname" id="lname">
    <span class="error" style="color: red">* Required</span>
    <br></br>
    <label for="fullname">Full Name: </label>
    <input type="text" name="fullname" id="fullname" readonly>
    <br></br>
    <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>'
<!-- added form.php file -->
<?php require 'form.php';?>
<!-- added js file -->
<script src="index.js"></script>