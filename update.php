<?php
include 'inc/header.php'; ?>

<?php
$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM Exercise WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}
$workout = mysqli_fetch_assoc($result);
$title = $workout['title'];
$loadLifted = $workout['loadLifted'];
$reps = $workout['reps'];


?>

<?php

$success = false;
$titleErr = $loadLiftedErr = $repsErr = '';


if (isset($_POST['submit'])) {

    //validate TITLE
    if (empty($_POST['title'])) {
        $titleErr = 'Title is required';
    } else {
        $title = filter_input(
            INPUT_POST,
            'title',
            FILTER_SANITIZE_SPECIAL_CHARS
        );
    }

    //VALIDATE LOAD
    if (empty($_POST['loadLifted'])) {
        $loadLiftedErr = 'Load Lifted is required';
    } else {
        $loadLifted = filter_input(
            INPUT_POST,
            'loadLifted',
            FILTER_SANITIZE_NUMBER_INT
        );
    }

    //validate reps
    if (empty($_POST['reps'])) {
        $repsErr = 'Reps is required';
    } else {
        $reps = filter_input(
            INPUT_POST,
            'reps',
            FILTER_SANITIZE_NUMBER_INT
        );
    }

    if (empty($titleErr) && empty($loadLiftedErr) && empty($repsErr)) {
        $sql = "UPDATE Exercise SET title='$title', 
        loadLifted='$loadLifted', reps='$reps' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($conn));
        } else {

            $titleErr = $loadLiftedErr = $repsErr = '';
            $success = true;

            header('Location:index.php');
        }
    }
}
?>
<h1 class="update-header">Update Page</h1>

<form action="update.php?id=<?php echo $id; ?>" method="POST" class="update-workout">
    <div class="exercise-container">
        <label for="exercise">Exercise Title</label>
        <input type="text" class="input-workout <?php echo $titleErr ? "input-error" : ""; ?>" name="title" value="<?php echo $title; ?>">
        <p class="error-message"><?php echo $titleErr; ?></p>
    </div>
    <div class="load-container">
        <label for="load">Load in Kgs</label>
        <input type="number" name="loadLifted" id="load" class="input-workout <?php echo $loadLiftedErr ? " input-error" : null; ?>" value="<?php echo $loadLifted; ?>">
        <p class="error-message"><?php echo $loadLiftedErr; ?></p>
    </div>
    <div class="reps-container">
        <label for="reps">Reps Taken</label>
        <input type="number" name="reps" id="reps" class="input-workout <?php echo $repsErr ? " input-error" : null; ?>" value="<?php echo $reps; ?>">
        <p class="error-message"><?php echo $repsErr; ?></p>
    </div>
    <div class="submit-container">
        <input type="submit" name="submit" value="update workout" class="btn">
    </div>
</form>
</body>

</html>