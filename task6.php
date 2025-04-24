<?php 
include 'check-session.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Task-2</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    form {
      background-color: #fff;
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="tel"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    textarea {
      resize: vertical;
    }

    .error {
      display: block;
      margin-top: -10px;
      margin-bottom: 10px;
      font-size: 0.9em;
    }

    button {
      background-color: #28a745;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    .pager {
      text-align: center;
      margin-top: 20px;
    }

    .pager a {
      display: inline-block;
      margin: 0 5px;
      padding: 10px 15px;
      text-decoration: none;
      background-color: #ccc;
      color: #000;
      border-radius: 5px;
    }

    .pager a:hover {
      background-color: #999;
    }

    .pager a:first-child {
      background-color: black;
      color: white;
    }
  </style>
</head>
<body>
  <h1>Fill the form</h1>
  <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <label for="fname">First Name:</label>
    <input type="text" name="fname" id="fname">
    <span class="error" style="color: red">* Required</span>

    <label for="lname">Last Name:</label>
    <input type="text" name="lname" id="lname">
    <span class="error" style="color: red">* Required</span>

    <label for="fullname">Full Name:</label>
    <input type="text" name="fullname" id="fullname" readonly>

    <label for="user_image">Upload Image:</label>
    <input type="file" name="user_image" id="user_image">
    <span class="error" style="color: red">* Required</span>

    <label for="marks">Subject Marks (Subject|marks):</label>
    <textarea name="marks" id="marks" rows="5" cols="25"></textarea>

    <label for="phone_no">Phone No.</label>
    <input type="tel" placeholder="+91 **********" name="phone_no" id="phone_no">
    <span class="error" style="color: red">* Required</span>

    <label for="email">Email:</label>
    <input type="text" name="email" id="email">
    <span class="error" style="color: red">* Required</span>

    <button type="submit" name="submit">Submit</button>
  </form>

  <div class="pager">
    <a href="index.php?q=1">Question 1</a>
    <a href="index.php?q=2">Question 2</a>
    <a href="index.php?q=3">Question 3</a>
    <a href="index.php?q=4">Question 4</a>
    <a href="index.php?q=5">Question 5</a>
    <a href="index.php?q=6">Question 6</a>
    <a href="logout.php">Logout</a>
  </div>

  <?php require 'form.php';?>
  <script src="index.js"></script>
</body>
</html>
