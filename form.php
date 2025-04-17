<?php
class Form {
  public $fname;
  public $lname;
  public $fullname;
  // constructor
  public function __construct() {
    // if fname filled is empty 
    if (empty($_POST['fname'])) {
      echo '<div class="output">Enter First Name</div><br>';

    }
    // to check fname contain alphabets
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['fname'])) {
      echo '<div class="output">First name can only contain letters!</div><br>';
    }
    else {
      // Initialize first name after data cleaning.
      $this->fname = $this->testInput($_POST['fname']);
    }
    // if lname filled is empty 
    if (empty($_POST['lname'])) {
      echo '<div class="output">Enter Last Name</div><br>';
    }
    // to check lname contain alphabets
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['lname'])) {
      echo '<div class="output">Last name can only contain letters!</div><br>';
    }
    else {
      // Initialize last name after data cleaning.
      $this->lname = $this->testInput($_POST['lname']);
    }
    // concatenate fname & lname to get fullname
    if (!empty($this->fname) && !empty($this->lname)) {
      $this->fullname = $this->fname . ' ' . $this->lname;
      echo '<div class="output"><h1>Hello ' . $this->fullname . '!</h1></div><br>';

    }
  }
  // function testIput
  public function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  // imageValidation function to store image
  public function imageValidation() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // file uploaded
      if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === 0) {
          $target_dir = "uploads/";  
          if (!is_dir($target_dir)) {
              mkdir($target_dir, 0777, true);  
          }
  
          $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          // file etension is cheked 
          $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
          if (!in_array($imageFileType, $allowed_extensions)) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          } else {
            // to display image if uploaded  
              if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
                echo "<img width='300' height='300' src='$target_file' /><br>";
                  echo"<h2>$this->fullname</h2>";
              } else {
                  echo "Error moving file to uploads directory.";
              }
          }
          // error if no file is uploaded
      } else {
          echo "No file uploaded or an error occurred.";
      }
    }
  }
}
  // to check method is post
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formdata = new Form();
    // imageValidation function called
    $formdata->imageValidation();
  }
?>