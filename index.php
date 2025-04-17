<!-- Form which user fills -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task-2</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color:pink;
    padding: 30px;
  }

  h1 {
    text-align: center;
    color: blue;
    font-size: 40px;
   }

  form {
    max-width: 500px;
    margin: 0 auto;
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
  }

  input[type="text"] {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  .error {
    font-size: 0.9em;
    color: red;
    margin-bottom: 10px;
    display: block;
  }

  button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 1em;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #218838;
  }
  .output {
  max-width: 500px;
  margin: 20px auto;
  padding: 15px;
  background-color: #e8f0fe;
  border-radius: 5px;
  text-align: center;
  font-family: Arial, sans-serif;
  color: #333;
}

</style>

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
    <label for="user_image">Upload Image: </label>
    <input type="file" name="user_image" id="user_image"><span class="error" style="color: red">* Required</span>
    <br><br>
    <label for="marks">Subject Marks (Subject|marks): </label>
    <br>
    <textarea name="marks" id="marks" rows="5" cols="25"></textarea>
    <br><br>
    <label for="phone_no">Phone No.</label>
    <input type="tel" placeholder="+91 **********" name="phone_no" id="phone_no">
    <span class="error" style="color: red">* Required</span>
    <br></br> 
    <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>'
<!-- added form.php file -->
<?php require 'form.php';?>
<!-- added js file -->
<script src="index.js"></script>
