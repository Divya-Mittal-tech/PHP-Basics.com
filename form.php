<?php
class Form {
  public $fname;
  public $lname;
  public $fullname;
  public $email;
  public $marksInput;    
  public $marksArray = [];
  public $phone_no;
  public $content;
  public $file_name;
  public function __construct() {
    if (empty($_POST['fname'])) {
      $this->content .= '<p style="color: red;">Enter First Name</p>';
    }
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['fname'])) {
      $this->content .= '<p style="color: red;">First name can only contain letters!</p>';
    }
    else {
      $this->fname = $this->testInput($_POST['fname']);
    }

    if (empty($_POST['lname'])) {
      $this->content .= '<p style="color: red;">Enter Last Name</p>';
    }
    elseif (!preg_match('/^[a-zA-Z]+$/', $_POST['lname'])) {
      $this->content .= '<p style="color: red;">Last name can only contain letters!</p>';
    }
    else {
      $this->lname = $this->testInput($_POST['lname']);
    }

    if (!empty($this->fname) && !empty($this->lname)) {
      $this->fullname = $this->fname . ' ' . $this->lname;
      $this->content .= '<h1>Hello ' . $this->full_name . '!</h1>';
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
            $this->content .= "<p style='color: red;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
          } else {
            if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
              $this->content .= "<p>Image moved to: $target_file</p>";
              $fullUrl = "http://" . $_SERVER['HTTP_HOST'] . "/" . $target_file;
              $this->content .= "<img width='300' height='300' src='$fullUrl' /><br>";
              $this->content .= "<h2>$this->fullname</h2>";
            } else {
              $this->content .= "<p style='color:red;'>Error moving file. Check folder permissions and path.</p>";
            }
            
          }
      } else {
        $this->content .= "<p style='color: red;'>No file uploaded.</p>";
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

          // Validate marks range.
          if ($mark <= 100) {
            $this->marksArray[] = [
              'subject' => $subject,
              'mark' => $mark,
            ];
          }
          else {
            $this->content .= "<p style='color: red;'>Marks for $subject must be between 0 and 100. You entered: $mark</p>";
            return;
          }
        }
        else {
          $this->content .= "<p style='color: red;'>Invalid format: $line (Correct format: Subject|Marks)</p>";
          return;
        }
      }
    }

    if (!empty($this->marksArray)) {
      $this->content .= "<h2>Your Marks:</h2>";
      $this->content .= "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>";
      $this->content .= "<tr><th>Subject</th><th>Marks</th></tr>";

      foreach ($this->marksArray as $entry) {
        $this->content .= "<tr>";
        $this->content .= "<td>" . htmlspecialchars($entry['subject']) . "</td>";
        $this->content .= "<td>" . htmlspecialchars($entry['mark']) . "</td>";
        $this->content .= "</tr>";
      }

      $this->content .= "</table>";
    }
    else {
      $this->content .= "<p style='color: red;'>No valid marks provided.</p>";
    }
  }
  public function phonenoValidation() {
    if(empty($_POST['phone_no'])){
      $this->content .= "First fill the phone no";
    }elseif(!preg_match('/^\+91\s?[6-9]\d{9}$/', $_POST['phone_no'])){
      $this->content .= "Invalid phone no enter the no which starts with +91 and must contain 10 digits";
    }
    else{
    $this->phone_no=$this->testInput($_POST['phone_no']);
    $this->content .= "<p>The phone no is: " .$this->phone_no. "<br></p>"; 
    }
  }
  public function validateEmailSyntax($email) {
    if (empty($email)) {
      $this->content .= "Email field is required.<br>";
        return false;
    }

    elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
      $this->content .= "Invalid email format.<br>";
        return false;
    }
    else {
        $accessKey = '83d582bd26393fe77e01a257f6fff341';
        $emailAddress = $this->testInput($email);

        $ch = curl_init('https://apilayer.net/api/check?access_key=' . $accessKey . '&email=' . urlencode($emailAddress));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        if ($json === false) {
          $this->content .= "<p style='color: red;'>API request failed: " . curl_error($ch) . "</p>";
            curl_close($ch);
            return;
        }
        curl_close($ch);

        $validationResult = json_decode($json, true);
        if (!$validationResult || !isset($validationResult['mx_found'])) {
          $this->content .= "<p style='color: red;'>API response error.</p>";
            return;
        }

        if (!$validationResult['mx_found']) {
          $this->content .= "<p style='color: red;'>Correct syntax but invalid email</p>";
        } else {
          $this->email = $emailAddress;
          $this->content .= '<p style="color: red;">Your Email is valid</p>';
          $this->content .= "<p>Email entered: " . $this->email . "</p>"; 
      }
    }
  }
  public function printContent() {
    $uploadsDir = "uploads";
    if (!is_dir($uploadsDir)) {
      mkdir($uploadsDir, 0777, true); 
    }
    $safeName = str_replace(' ', '_', $this->fullname);
    $serverFileName = "$uploadsDir/{$safeName}.doc";
    $this->file_name = fopen($serverFileName, "w") or die("Unable to open file: $serverFileName");
    fwrite($this->file_name, $this->content);
    fclose($this->file_name);
    echo $this->content;
  }
  
  

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $formdata = new Form();
  switch ($_GET['q']) {
    case 1:
      echo $formdata->content;
      break;
    case 2:
      $formdata->imageValidation();
      echo $formdata->content;
      break;
    case 3:
      $formdata->imageValidation();
      $formdata->marksValidation();
      echo $formdata->content;
      break;
    case 4:
      $formdata->imageValidation();
      $formdata->marksValidation();
      $formdata->phonenoValidation();
      echo $formdata->content;
      break;
    case 5:
      $formdata->imageValidation();
      $formdata->marksValidation();
      $formdata->phonenoValidation();
      $formdata->validateEmailSyntax();
      echo $formdata->content;
      break;
    case 6:
      $formdata->imageValidation();
      $formdata->marksValidation();
      $formdata->phonenoValidation();
      $formdata->validateEmailSyntax();
      $formdata->printContent();
      header("Content-type: application/vnd.ms-word");
      header("Content-Disposition: attachment;Filename=form-data.doc");
      header("Pragma: no-cache");
      header("Expires: 0");
      break;
    default:
      echo "<h1>Error</h1>";
  }
}

?>