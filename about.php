<?php
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h3>YOUR DETAILS</h3>
        </div>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <label>Name:</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['name']; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['email']; ?>" readonly>
                </div>
            </div><br>

            <div class="form-group">
                <label>Facebook URL:</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['facebook_url']; ?>" readonly>
            </div><br>
            
            <div class="row">
                <div class="col-md-6">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['phone']; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label>Gender:</label>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['gender']; ?>" readonly> 
                </div>
            </div><br>
            
            <div class="form-group">
                <label>Country:</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['country']; ?>" readonly>
            </div><br>

            <div class="form-group">
                <label>Skills:</label>
                <input type="text" class="form-control" value="<?php echo implode(", ", $_SESSION['skills']); ?>" readonly>
            </div><br>

            <div class="form-group">
                <label>Biography:</label>
                <textarea class="form-control" rows="4" readonly><?php echo $_SESSION['biography']; ?></textarea>
            </div><br>

            <div class="form-group">
                <a href="registration.form.php" class="btn btn-success">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
