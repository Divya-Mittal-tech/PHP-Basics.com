<?php
class Form {
  public $fname, $lname, $fullname, $email, $phone_no;
  public $marksInput, $marksArray = [];
  public $content = '';
  public $file_name;

  public function __construct() {
    if (empty($_POST['fname'])) {
      $this->content .= '<p style="color: red;">Enter First Name</p>';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['fname'])) {
      $this->content .= '<p style="color: red;">First name can only contain letters!</p>';
    } else {
      $this->fname = $this->testInput($_POST['fname']);
    }

    if (empty($_POST['lname'])) {
      $this->content .= '<p style="color: red;">Enter Last Name</p>';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['lname'])) {
      $this->content .= '<p style="color: red;">Last name can only contain letters!</p>';
    } else {
      $this->lname = $this->testInput($_POST['lname']);
    }

    if (!empty($this->fname) && !empty($this->lname)) {
      $this->fullname = $this->fname . ' ' . $this->lname;
      $this->content .= "<h1>Hello $this->fullname!</h1>";
    }
  }

  public function testInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  public function imageValidation() {
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === 0) {
      $target_dir = "uploads/";
      if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
      $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
      $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      if (!in_array($imageFileType, $allowed_extensions)) {
        $this->content .= "<p style='color: red;'>Only JPG, JPEG, PNG & GIF files are allowed.</p>";
      } else {
        if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
          $fullUrl = "http://" . $_SERVER['HTTP_HOST'] . "/" . $target_file;
          $this->content .= "<img width='300' height='300' src='$fullUrl' /><br>";
          $this->content .= "<h2>$this->fullname</h2>";
        } else {
          $this->content .= "<p style='color:red;'>Error moving file.</p>";
        }
      }
    } else {
      $this->content .= "<p style='color: red;'>No file uploaded.</p>";
        }
  }

  public function marksValidation() {
    if (!empty($_POST['marks'])) {
      $this->marksInput = $_POST['marks'];
      $lines = explode("\n", trim($this->marksInput));
      $valid = true;

      foreach ($lines as $line) {
        $line = trim($line);
        if (preg_match("/^[a-zA-Z\s]+\|[0-9]+$/", $line)) {
          list($subject, $mark) = explode('|', $line);
          $mark = (int) $mark;
          $subject = preg_replace('/\s+/', '', trim($subject));

          if ($mark <= 100) {
            $this->marksArray[] = ['subject' => $subject, 'mark' => $mark];
          } else {
            $this->content .= "<p style='color: red;'>Marks for $subject must be between 0 and 100. You entered: $mark</p>";
            $valid = false;
            break;
          }
        } else {
          $this->content .= "<p style='color: red;'>Invalid format: $line (Correct format: Subject|Marks)</p>";
          $valid = false;
          break;
        }
      }

      if ($valid && !empty($this->marksArray)) {
        $this->content .= "<h2>Your Marks:</h2>";
        $this->content .= "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>";
        $this->content .= "<tr><th>Subject</th><th>Marks</th></tr>";
        foreach ($this->marksArray as $entry) {
          $this->content .= "<tr><td>" . htmlspecialchars($entry['subject']) . "</td><td>" . htmlspecialchars($entry['mark']) . "</td></tr>";
        }
        $this->content .= "</table>";
      }
    } else {
      $this->content .= "<p style='color: red;'>No marks data provided.</p>";
    }
  }

  public function phonenoValidation() {
    if (empty($_POST['phone_no'])) {
      $this->content .= "<p style='color: red;'>Enter phone number.</p>";
    } else {
      $input = preg_replace('/\s+/', '', $_POST['phone_no']);
      if (preg_match('/^[6-9]\d{9}$/', $input)) {
        $input = '+91' . $input;
      }
      if (!preg_match('/^\+91[6-9]\d{9}$/', $input)) {
        $this->content .= "<p style='color: red;'>Invalid phone number.</p>";
      } else {
        $this->phone_no = $this->testInput($input);
        $this->content .= "<p>Phone: $this->phone_no</p>";
      }
    }
  }

  public function validateEmailSyntax($email) {
    if (empty($email)) {
      $this->content .= "<p style='color: red;'>Email required.</p>";
      return;
    }
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
      $this->content .= "<p style='color: red;'>Invalid email format.</p>";
      return;
    }

    $emailAddress = $this->testInput($email);
    $accessKey = '83d582bd26393fe77e01a257f6fff341';
    $ch = curl_init("https://apilayer.net/api/check?access_key=$accessKey&email=" . urlencode($emailAddress) . "&smtp=1");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $validation = json_decode($json, true);

    if (!$validation || !isset($validation['smtp_check'])) {
      $this->content .= "<p style='color: red;'>API error or invalid response.</p>";
    } elseif (!$validation['smtp_check']) {
      $this->content .= "<p style='color: red;'>Email syntax valid but address doesn't exist.</p>";
    } else {
      $this->email = $emailAddress;
      $this->content .= "<p style='color: green;'>Email is valid and exists.</p><p>Email: $this->email</p>";
    }
  }

  public function printContent() {
    $uploadsDir = "uploads";
    if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0777, true);
    $safeName = str_replace(' ', '_', $this->fullname);
    $serverFile = "$uploadsDir/{$safeName}.doc";
    file_put_contents($serverFile, $this->content);
    echo $this->content;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  ob_start(); // Ensure nothing is sent before headers

  $form = new Form();
  $form->imageValidation();
  $form->marksValidation();
  $form->phonenoValidation();
  $form->validateEmailSyntax($_POST['email'] ?? '');

  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment;Filename=form-data.doc");
  header("Pragma: no-cache");
  header("Expires: 0");

  $form->printContent();
  ob_end_flush(); 
}
?>
