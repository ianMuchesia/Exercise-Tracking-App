<?php
include 'inc/header.php';

?>

<?php
$email = $password =$authErr= '';
$emailErr = $passwordErr = '';

if (empty($_POST['email'])) {
  $emailErr = 'please provide email';
} else {
  $email = filter_input(
    INPUT_POST,
    'email',
    FILTER_SANITIZE_EMAIL
  );
}

if (empty($_POST['password'])) {
  $passwordErr = 'please provide password';
} else {
  $password = filter_input(
    INPUT_POST,
    'password',
    FILTER_SANITIZE_SPECIAL_CHARS
  );
}

$emailSQL = "SELECT email,password from Users WHERE LOWER(email)
=LOWER('$email')";
$result = mysqli_query($conn, $emailSQL);
$row = mysqli_fetch_assoc($result);

 if(!$row['email']){
   $emailErr = 'No account exists with the given Email';
 }
 //verify the password
 if(empty($emailErr) && $row['password'] && password_verify($password,$row['password'])){
  echo 'Login Success!';
 }else{
  $authErr = 'Invalid Details! Password and Email did not match';
 }

?>

<div class="login-page">
  <form class="form-login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

    <p class="form-title">Sign in to your account</p>
    <div class="input-container">
      <input placeholder="Enter email" type="email" name="email" class="<?php echo $emailErr ? "input-error" : null; ?>" value="<?php echo $email; ?>">
      <p class="error-message"><?php echo $emailErr; ?></p>

    </div>
    <div class="input-container">
      <input placeholder="Enter password" name="password" type="password" class="<?php echo $passwordErr ? "input-error" : null; ?>" value="<?php echo $password; ?>">
      <p class="error-message"><?php echo $passwordErr; ?></p>


    </div>
    <p class="error-message"><?php echo $authErr; ?></p>
    <input name="submit" class="submit" type="submit" value="Sign In">

    <p class="signup-link">
      No account?
      <a href="/exercise_app/signup.php">Sign up</a>
    </p>
  </form>
</div>
</body>

</html>