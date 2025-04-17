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
}
  // to check method is post
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formdata = new Form();
  }
?>