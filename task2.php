<?php 
include 'check-session.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task-2</title>
</head>
<body>
  <h1>Fill the form</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?q=2'); ?>" enctype="multipart/form-data">
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