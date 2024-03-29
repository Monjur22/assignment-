<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $matricNo = test_input($_POST["matricNo"]);
    $currentAddress = test_input($_POST["currentAddress"]);
    $homeAddress = test_input($_POST["homeAddress"]);
    $email = test_input($_POST["email"]);
    $mobilePhone = test_input($_POST["mobilePhone"]);
    $homePhone = test_input($_POST["homePhone"]);

    // Client-side validation
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $error = "Invalid name format";
    } elseif (!preg_match("/^\d{10}$/", $mobilePhone)) {
        $error = "Invalid mobile phone number format";
    } elseif (!empty($homePhone) && !preg_match("/^\d{10}$/", $homePhone)) {
        $error = "Invalid home phone number format";
    } else {
        // Server-side validation passed
        echo "Form submitted successfully!";
        // You can perform further processing here
        exit;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Form</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Student Form</h2>
  <?php if (!empty($error)): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  <form id="studentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="name">Name (Legal/Official):</label>
    <input type="text" id="name" name="name" required pattern="[a-zA-Z\s]+" title="Only letters and spaces are allowed"><br>

    <label for="matricNo">Matric No:</label>
    <input type="text" id="matricNo" name="matricNo" required><br>

    <label for="currentAddress">Current Address:</label>
    <textarea id="currentAddress" name="currentAddress" required></textarea><br>

    <label for="homeAddress">Home Address:</label>
    <textarea id="homeAddress" name="homeAddress" required></textarea><br>

    <label for="email">Email (Gmail Account):</label>
    <input type="email" id="email" name="email" required><br>

    <label for="mobilePhone">Mobile Phone No:</label>
    <input type="text" id="mobilePhone" name="mobilePhone" required pattern="[0-9]{10}" title="Please enter a 10-digit mobile phone number"><br>

    <label for="homePhone">Home Phone No (Emergency):</label>
    <input type="text" id="homePhone" name="homePhone" pattern="[0-9]{10}" title="Please enter a 10-digit home phone number"><br>

    <input type="submit" value="Submit">
  </form>

  <script src="js/validation.js"></script>
</body>
</html>
