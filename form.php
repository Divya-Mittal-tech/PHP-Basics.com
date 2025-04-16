<?php
class Form {
  public $fname;
  public $lname;
  public $fullname;
  // constructor
  public function __construct() {
    // if fname filled is empty 
    if (empty($_POST['fname'])) {
      echo "Enter First Name<br>";
    }
    // to check fname contain alphabets
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['fname'])) {
      echo "First name can only contain letters!<br>";
    }
    else {
      // Initialize first name after data cleaning.
      $this->fname = $this->testInput($_POST['fname']);
    }
    // if lname filled is empty 
    if (empty($_POST['lname'])) {
      echo "Enter Last Name<br>";
    }
    // to check lname contain alphabets
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['lname'])) {
      echo "Last name can only contain letters!<br>";
    }
    else {
      // Initialize last name after data cleaning.
      $this->lname = $this->testInput($_POST['lname']);
    }
    // concatenate fname & lname to get fullname
    if (!empty($this->fname) && !empty($this->lname)) {
      $this->fullname = $this->fname . ' ' . $this->lname;
      echo '<h1>Hello ' . $this->fullname . '!</h1><br>';
    }
  }
  // function testIput
  public function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
}
  // to check method is post
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formdata = new Form();
  }
?>