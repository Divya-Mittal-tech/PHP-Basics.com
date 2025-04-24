<?php
class Form {
  public $fname;
  public $lname;
  public $fullname;
  public $marksInput;    
  public $marksArray = [];
  public $phone_no;

  public function __construct() {
    if (empty($_POST['fname'])) {
      echo '<div class="output">Enter First Name</div><br>';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['fname'])) {
      echo '<div class="output">First name can only contain letters!</div><br>';
    } else {
      $this->fname = $this->testInput($_POST['fname']);
    }

    if (empty($_POST['lname'])) {
      echo '<div class="output">Enter Last Name</div><br>';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['lname'])) {
      echo '<div class="output">Last name can only contain letters!</div><br>';
    } else {
      $this->lname = $this->testInput($_POST['lname']);
    }

    if (!empty($this->fname) && !empty($this->lname)) {
      $this->fullname = $this->fname . ' ' . $this->lname;
      echo '<div class="output"><h1>Hello ' . $this->fullname . '!</h1></div><br>';
    }
  }

  public function testInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
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
          echo "<div class='output'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
        } else {
          if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            echo "<div class='output'>";
            echo "<img width='300' height='300' src='$target_file' /><br>";
            echo "<h2>$this->fullname</h2>";
            echo "</div>";
          } else {
            echo "<div class='output'>Error moving file to uploads directory.</div>";
          }
        }
      } else {
        echo "<div class='output'>No file uploaded or an error occurred.</div>";
      }
    }
  }

  public function marksValidation() {
    if (!empty($_POST['marks'])) {
      $this->marksInput = $_POST['marks'];
      $lines = explode("\n", trim($this->marksInput));

      foreach ($lines as $line) {
        $line = trim($line);
        if (preg_match("/^[a-zA-Z\s]+\|[0-9]+$/", $line)) {
          list($subject, $mark) = explode('|', $line);
          $mark = (int) $mark;
          $subject = preg_replace('/\s+/', '', trim($subject));

          if ($mark <= 100) {
            $this->marksArray[] = ['subject' => $subject, 'mark' => $mark];
          } else {
            echo "<div class='output' style='color: red;'>Marks for $subject must be between 0 and 100. You entered: $mark</div>";
            return;
          }
        } else {
          echo "<div class='output' style='color: red;'>Invalid format: $line (Correct format: Subject|Marks)</div>";
          return;
        }
      }
    }

    if (!empty($this->marksArray)) {
      echo "<div class='output'>";
      echo "<h2>Your Marks:</h2>";
      echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>";
      echo "<tr><th>Subject</th><th>Marks</th></tr>";
      foreach ($this->marksArray as $entry) {
        echo "<tr><td>" . htmlspecialchars($entry['subject']) . "</td><td>" . htmlspecialchars($entry['mark']) . "</td></tr>";
      }
      echo "</table></div>";
    } else {
      echo "<div class='output' style='color: red;'>No valid marks provided.</div>";
    }
  }

  public function phonenoValidation() {
    if (empty($_POST['phone_no'])) {
      echo "<div class='output'>First fill the phone number.</div>";
    } else {
      $input = preg_replace('/\s+/', '', $_POST['phone_no']);

      if (preg_match('/^[6-9]\d{9}$/', $input)) {
        $input = '+91' . $input;
      }

      if (!preg_match('/^\+91[6-9]\d{9}$/', $input)) {
        echo "<div class='output'>Invalid phone number. Enter a 10-digit number starting with 6-9 or use +91 format.</div>";
      } else {
        $this->phone_no = $this->testInput($input);
        echo "<div class='output'><p>The phone number is: $this->phone_no</p></div>"; 
      }
    }
  }
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $formdata = new Form();
  $formdata->imageValidation();
  $formdata->marksValidation();
  $formdata->phonenoValidation();
}
?>
