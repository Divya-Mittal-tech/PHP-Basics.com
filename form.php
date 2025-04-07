<?php
class Form {
  public $fname;
  public $lname;
  public $fullname;
  public function __construct() {
    if (empty($_POST['fname'])) {
      echo "Enter First Name<br>";
    }
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['fname'])) {
      echo "First name can only contain letters!<br>";
    }
    else {
      $this->fname = $this->testInput($_POST['fname']);
    }

    if (empty($_POST['lname'])) {
      echo "Enter Last Name<br>";
    }
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['lname'])) {
      echo "Last name can only contain letters!<br>";
    }
    else {
      // Initialize last name after data cleaning.
      $this->lname = $this->testInput($_POST['lname']);
    }

    if (!empty($this->fname) && !empty($this->lname)) {
      $this->fullname = $this->fname . ' ' . $this->lname;
      echo '<h1>Hello ' . $this->fullname . '!</h1><br>';
    }
  }
  public function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  public function imageValidation() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === 0) {
          $target_dir = "uploads/";  
          if (!is_dir($target_dir)) {
              mkdir($target_dir, 0777, true);  
          }
  
          $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  
          
          
          $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
          if (!in_array($imageFileType, $allowed_extensions)) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          } else {
              if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
                echo "<img width='300' height='300' src='$target_file' /><br>";
                  echo"<h2>$this->fullname</h2>";
              } else {
                  echo "Error moving file to uploads directory.";
              }
          }
      } else {
          echo "No file uploaded or an error occurred.";
      }
    }
  }
}
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formdata = new Form();
    $formdata->imageValidation();
  }
?>