<?php 
include 'check-session.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Task-1</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-top: 20px;
    }

    form {
      background-color: #fff;
      max-width: 600px;
      margin: 30px auto;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    input[type="text"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .error {
      color: red;
      font-size: 0.85em;
    }

    textarea {
      resize: vertical;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .pager {
      text-align: center;
      margin-top: 40px;
    }

    .pager a {
      display: inline-block;
      text-decoration: none;
      background-color: #e0e0e0;
      padding: 10px 15px;
      margin: 5px;
      border-radius: 6px;
      color: black;
      font-weight: 500;
    }

    .pager a:hover {
      background-color: #bdbdbd;
    }

    .pager a[href*="q=3"] {
      background-color: black;
      color: white;
    }
  </style>
</head>
<body>
  <h1>Fill the form</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?q=1'); ?>">
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
    <div class="pager">
        <a style="background-color: black; color: white;" href="index.php?q=<?php echo $taskNumber = 1; ?>">Question 1</a>
        <a href="index.php?q=<?php echo $taskNumber = 2; ?>">Question 2</a>
        <a href="index.php?q=<?php echo $taskNumber = 3; ?>">Question 3</a>
        <a href="index.php?q=<?php echo $taskNumber = 4; ?>">Question 4</a>
        <a href="index.php?q=<?php echo $taskNumber = 5; ?>">Question 5</a>
        <a href="index.php?q=<?php echo $taskNumber = 6; ?>">Question 6</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
<?php require 'form.php';?>
<script src="index.js"></script>