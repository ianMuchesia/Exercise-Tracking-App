<?php
include 'inc/header.php';

?>

<?php

//form submit
$name = $password = $email = $confirmPassword = '';
$nameErr = $passwordErr = $emailErr = '';

if (isset($_POST['submit'])) {

    //validate name
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        $name = filter_input(
            INPUT_POST,
            'name',
            FILTER_SANITIZE_SPECIAL_CHARS

        );
    }

    //validate password
    if (empty($_POST['password']) || empty($_POST['confirmPassword'])) {
        $passwordErr = 'Password is required';
    }

    

    if (strlen( $_POST['password']) < 8) {
        $passwordErr = 'Password must be at least 8 characters long';
    }


    if ($confirmPassword !== $password && empty($passwordErr)) {
        $passwordErr = 'Passwords do not match';
    } else {

        $password = filter_input(
            INPUT_POST,
            'password',
            FILTER_SANITIZE_SPECIAL_CHARS

        );
    }

    //validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_SANITIZE_EMAIL

        );
    }




    $emailSQL = "SELECT email FROM Users WHERE LOWER(email) = LOWER('$email')";
    $result = mysqli_query($conn, $emailSQL);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $emailErr = 'Email already exists';
    }
    if (empty($nameErr) && empty($passwordErr) && empty($emailErr)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO Users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        if ($stmt->execute()) {
            $email = $name = $password = $confirmPassword = '';
            $nameErr = $passwordErr = $emailErr = '';
            header('Location: index.php');
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>


<div class="login-page">
    <form class="form-login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <p class="form-title">Sign up to open your account</p>


        <div class="input-container">
            <input placeholder="Enter name" type="text" name="name" class="<?php echo $nameErr ? "input-error" : null; ?>" value="<?php echo $name; ?>">
            <p class="error-message"><?php echo $nameErr; ?></p>
        </div>
        <div class="input-container">
            <input placeholder="Enter email" type="email" name="email" class="<?php echo $emailErr ? "input-error" : null; ?>" value="<?php echo $email; ?>">
            <p class="error-message"><?php echo $emailErr; ?></p>

        </div>
        <div class="input-container">
            <input placeholder="Enter password" name="password" type="password" class="<?php echo $passwordErr ? "input-error" : null; ?>" value="<?php echo $password; ?>">
            <p class="error-message"><?php echo $passwordErr; ?></p>


        </div>
        <div class="input-container">
            <input placeholder="Confirm password" name="     confirmPassword" type="password" class="<?php echo $passwordErr ? "input-error" : null; ?>" value="<?php echo $confirmPassword; ?>">

            <p class="error-message"><?php echo $passwordErr; ?></p>

        </div>
        <input name="submit" class="submit" type="submit" value="Sign Up">


        <p class="signup-link">
            Have an account?
            <a href="/exercise_app/login.php">Sign in</a>
        </p>
    </form>
</div>
</body>

</html>