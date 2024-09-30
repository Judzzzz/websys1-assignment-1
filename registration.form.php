<?php
session_start();

$name = "";
$email = "";
$facebook_url = "";
$password = "";
$confirm_password = "";
$phone = "";
$gender = "";
$country = "";
$biography = "";
$skills = [];
$errorMessage = [];

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Name
    if (empty($_POST["name"])) {
        $errorMessage['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]*$/", $_POST["name"])) {
        $errorMessage['name'] = "Name must only contain letters and spaces.";
    } else {
        $name = sanitizeInput($_POST["name"]);
    }

    // Email
    if (empty($_POST["email"])) {
        $errorMessage['email'] = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errorMessage['email'] = "Invalid email format.";
    } else {
        $email = sanitizeInput($_POST["email"]);
    }

    // Facebook URL
    if (empty($_POST["facebook_url"])) {
      $errorMessage['facebook_url'] = "Facebook URL is required.";
    } elseif (!filter_var($_POST["facebook_url"], FILTER_VALIDATE_URL)) {
        $errorMessage['facebook_url'] = "Invalid URL format.";
    } else {
        $facebook_url = sanitizeInput($_POST["facebook_url"]);
    }

    // Password
    if (empty($_POST["password"])) {
        $errorMessage['password'] = "Password is required.";
    } elseif (strlen($_POST["password"]) < 8 || !preg_match('/[A-Z]/', $_POST["password"])) {
        $errorMessage['password'] = "Password must be at least 8 characters and contain at least 1 uppercase letter.";
    } else {
        $password = sanitizeInput($_POST["password"]);
    }

    // Confirm Password
    if (empty($_POST["confirm_password"])) {
        $errorMessage['confirm_password'] = "Please confirm your password.";
    } elseif ($_POST["confirm_password"] !== $password) {
        $errorMessage['confirm_password'] = "Passwords do not match.";
    } else {
        $confirm_password = sanitizeInput($_POST["confirm_password"]);
    }

    // Phone Number
    if (empty($_POST["phone"])) {
        $errorMessage['phone'] = "Phone number is required.";
    } elseif (!is_numeric($_POST["phone"])) {
        $errorMessage['phone'] = "Please input a valid phone number.";
    } else {
        $phone = sanitizeInput($_POST["phone"]);
    }

    // Gender
    if (empty($_POST["gender"])) {
        $errorMessage['gender'] = "Gender is required.";
    } else {
        $gender = sanitizeInput($_POST["gender"]);
    }

    // Country
    if (empty($_POST["country"])) {
        $errorMessage['country'] = "Country is required.";
    } else {
        $country = sanitizeInput($_POST["country"]);
    }

    // Skills
    if (empty($_POST["skills"])) {
        $errorMessage['skills'] = "Please select at least one skill.";
    } else {
        $skills = $_POST["skills"];
    }

    // Biography
    if (empty($_POST["biography"])) {
        $errorMessage['biography'] = "Biography is required.";
    } elseif (strlen($_POST["biography"]) > 200) {
        $errorMessage['biography'] = "Biography must be under 200 characters.";
    } else {
        $biography = sanitizeInput($_POST["biography"]);
    }

    if (empty($errorMessage)) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['facebook_url'] = $facebook_url;
        $_SESSION['phone'] = $phone;
        $_SESSION['gender'] = $gender;
        $_SESSION['country'] = $country;
        $_SESSION['skills'] = $skills;
        $_SESSION['biography'] = $biography;

        echo '<script>
        location.href = "about.php";
        </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h3>REGISTRATION FORM</h3>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? sanitizeInput($_POST['name']) : $name; ?>">
                <?php if (isset($errorMessage['name'])): ?>
                    <small class="text-danger"><?php echo $errorMessage['name']; ?></small>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label>Email:</label>
                <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? sanitizeInput($_POST['email']) : $email; ?>">
                <?php if (isset($errorMessage['email'])): ?>
                    <small class="text-danger"><?php echo $errorMessage['email']; ?></small>
                <?php endif; ?>
            </div>
        </div><br>

        <div class="form-group">
            <label>Facebook URL:</label>
            <input type="text" name="facebook_url" class="form-control" value="<?php echo isset($_POST['facebook_url']) ? sanitizeInput($_POST['facebook_url']) : $facebook_url; ?>">
            <?php if (isset($errorMessage['facebook_url'])): ?>
                <small class="text-danger"><?php echo $errorMessage['facebook_url']; ?></small>
            <?php endif; ?>
        </div><br>

        <div class="row">
            <div class="col-md-6">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" value="<?php echo isset($_POST['password']) ? sanitizeInput($_POST['password']) : ''; ?>">
                <?php if (isset($errorMessage['password'])): ?>
                    <small class="text-danger"><?php echo $errorMessage['password']; ?></small>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo isset($_POST['confirm_password']) ? sanitizeInput($_POST['confirm_password']) : ''; ?>">
                <?php if (isset($errorMessage['confirm_password'])): ?>
                    <small class="text-danger"><?php echo $errorMessage['confirm_password']; ?></small>
                <?php endif; ?>
            </div>
        </div><br>

        <div class="form-group">
            <label>Phone Number:</label>
            <input type="text" name="phone" class="form-control" value="<?php echo isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : $phone; ?>">
            <?php if (isset($errorMessage['phone'])): ?>
                <small class="text-danger"><?php echo $errorMessage['phone']; ?></small>
            <?php endif; ?>
        </div><br>

        <div class="form-group">
            <label>Gender:</label><br>
            <input type="radio" name="gender" value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Male') ? 'checked' : ''; ?>> Male <br>
            <input type="radio" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Female') ? 'checked' : ''; ?>> Female
            <?php if (isset($errorMessage['gender'])): ?>
                <small class="text-danger"><?php echo $errorMessage['gender']; ?></small>
            <?php endif; ?>
        </div><br>

        <div class="form-group">
            <label>Country:</label>
            <select name="country" class="form-control">
                <option value="">Select Country</option>
                <option value="Australia" <?php echo ($country == "Australia") ? 'selected' : ''; ?>>Australia</option>
                <option value="Canada" <?php echo ($country == "Canada") ? 'selected' : ''; ?>>Canada</option>
                <option value="Italy" <?php echo ($country == "Italy") ? 'selected' : ''; ?>>Italy</option>
                <option value="Japan" <?php echo ($country == "Japan") ? 'selected' : ''; ?>>Japan</option>
                <option value="United Kingdom" <?php echo ($country == "United Kingdom") ? 'selected' : ''; ?>>United Kingdom</option>
                <option value="USA" <?php echo ($country == "USA") ? 'selected' : ''; ?>>USA</option>
                <option value="Philippines" <?php echo ($country == "Philippines") ? 'selected' : ''; ?>>Philippines</option>
            </select>
            <?php if (isset($errorMessage['country'])): ?>
                <small class="text-danger"><?php echo $errorMessage['country']; ?></small>
            <?php endif; ?>
        </div><br>

        <div class="form-group">
            <label>Skills:</label><br>
            <input type="checkbox" name="skills[]" value="PHP" <?php if (isset($_POST['skills']) && in_array("PHP", $_POST['skills'])) echo "checked"; ?>> PHP<br>
            <input type="checkbox" name="skills[]" value="JavaScript" <?php if (isset($_POST['skills']) && in_array("JavaScript", $_POST['skills'])) echo "checked"; ?>> JavaScript<br>
            <input type="checkbox" name="skills[]" value="Python" <?php if (isset($_POST['skills']) && in_array("Python", $_POST['skills'])) echo "checked"; ?>> Python<br>
            <input type="checkbox" name="skills[]" value="Java" <?php if (isset($_POST['skills']) && in_array("Java", $_POST['skills'])) echo "checked"; ?>> Java<br>
            <?php if (isset($errorMessage['skills'])): ?>
                <small class="text-danger"><?php echo $errorMessage['skills']; ?></small>
            <?php endif; ?>
        </div><br>

        <div class="form-group">
            <label>Biography:</label>
            <textarea name="biography" class="form-control" rows="4"><?php echo isset($_POST['biography']) ? sanitizeInput($_POST['biography']) : $biography; ?></textarea>
            <?php if (isset($errorMessage['biography'])): ?>
                <small class="text-danger"><?php echo $errorMessage['biography']; ?></small>
            <?php endif; ?>
        </div><br>

        <input type="submit" value="Submit" class="btn btn-primary">
    </form>

    </div>
</body>
</html>
