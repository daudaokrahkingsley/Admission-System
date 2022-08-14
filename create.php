<?php
require_once "config.php";

$first_name = $last_name = $class = $phone_number = $address = "";
$first_name_error = $last_name_error = $class_error = $phone_number_error = $address_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first_name"]);
    if (empty($firstName)) {
        $first_name_error = "First Name is required.";
    } elseif (!filter_var($firstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $first_name_error = "First Name is invalid.";
    } else {
        $firstName = $firstName;
    }

    $lastName = trim($_POST["last_name"]);

    if (empty($lastName)) {
        $last_name_error = "Last Name is required.";
    } elseif (!filter_var($firstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $last_name_error = "Last Name is invalid.";
    } else {
        $lastName = $lastName;
    }

    $class = trim($_POST["class"]);
    if (empty($class)) {
        $email_error = "class is required.";
    } elseif (!filter_var($firstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $class_error = "Please enter a valid email.";
    } else {
        $class = $class;
    }

    $phoneNumber = trim($_POST["phone_number"]);
    if(empty($phoneNumber)){
        $phone_number_error = "Phone Number is required.";
    } else {
        $phoneNumber = $phoneNumber;
    }

    $address = trim($_POST["address"]);
    if(empty($address)){
        $address_error = "Address is required.";
    } else {
        $address = $address;
    }

    if (empty($first_name_error_err) && empty($last_name_error) && empty($email_error) && empty($phone_number_error) && empty($address_error) ) {
          $sql = "INSERT INTO `users` (`first_name`, `last_name`, `class`, `phone_number`, `address`) VALUES ('$firstName', '$lastName', '$class', '$phoneNumber', '$address')";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
               echo "Something went wrong. Please try again later.";
          }
      }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Students</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($first_name_error)) ? 'has-error' : ''; ?>">
                            <label> Students' First Name</label>
                            <input type="text" name="first_name" class="form-control" value="">
                            <span class="help-block"><?php echo $first_name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($last_name_error)) ? 'has-error' : ''; ?>">
                            <label>Students' Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="">
                            <span class="help-block"><?php echo $last_name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
                            <label>Class/Form</label>
                            <input type="text" name="class" class="form-control" value="">
                            <span class="help-block"><?php echo $class_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($phone_number_error)) ? 'has-error' : ''; ?>">
                            <label>Parents' Phone Number</label>
                            <input type="number" name="phone_number" class="form-control" value="">
                            <span class="help-block"><?php echo $phone_number_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($address_error)) ? 'has-error' : ''; ?>">
                            <label>Address/Home Town</label>
                            <textarea name="address" class="form-control"></textarea>
                            <span class="help-block"><?php echo $address_error;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>