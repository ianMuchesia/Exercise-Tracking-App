<?php
include 'inc/header.php';

?>


<?php
//Form submit
$title = $loadLifted = $reps = '';
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
        $sql = "INSERT INTO Exercise (title, loadLifted,reps) VALUES('$title','$loadLifted','$reps')";

        if (mysqli_query($conn, $sql)) {
            $title = $loadLifted = $reps = '';
            $titleErr = $loadLiftedErr = $repsErr = '';
            header('Location:index.php');
        } else {

            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<?php
$sql = 'SELECT * FROM Exercise ORDER BY date DESC';
$result = mysqli_query($conn, $sql);
$workouts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Exercise WHERE id='$id'";
    $result = mysqli_query($conn , $sql);
    if (!$result) {
            echo "Error: ". mysqli_error($conn);
        } else {
            $success = true;
            header('Location:index.php');
        
        }
}
?>


<?php
    function changeDate($db_date){
        $timestamp = strtotime($db_date);
        $currentTimestamp = time();
        $elapsedTime = $currentTimestamp - $timestamp;

        if($elapsedTime<60){
            $output = $elapsedTime . " seconds ago";
        }elseif ($elapsedTime < 3600) {
            $minutes = floor($elapsedTime / 60);
            $output = $minutes . " minutes ago";
        } elseif ($elapsedTime < 86400) {
            $hours = floor($elapsedTime / 3600);
            $output = $hours . " hours ago";
        } elseif ($elapsedTime < 2592000) {
            $days = floor($elapsedTime / 86400);
            $output = $days . " days ago";
        } else {
            $years = floor($elapsedTime / 31536000);
            $output = $years . " years ago";
        }
        return $output;
    }
?>



<main>
    <div class="left">
        <div class="illustration">
            <img src="images/Exercise.png" alt="exercie image">
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="add-workout">
            <div class="exercise-container">
                <label for="exercise">Exercise Title</label>
                <input type="text" class="input-workout <?php echo $titleErr ? "input-error" : null; ?>" name="title" value="<?php echo $title; ?>">
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
                <input type="submit" name="submit" value="Add Workout" class="btn">
            </div>
        </form>
    </div>
    <div class="workouts">
        <h2>Workouts</h2>
        <div class="workouts-container">
            <?php
            if (empty($workouts)) :
            ?>
                <h4>You don't have any workouts</h4>
            <?php endif; ?>

            <?php
            foreach ($workouts as $workout) : ?>
                <div class="workout-card">
                    <div class="details-container">
                        <h4>title: <?php echo $workout['title']; ?></h4>
                        <h5>Load: <?php echo $workout['loadLifted']; ?></h5>
                        <h5>Number of Reps: <?php echo $workout['reps']; ?></h5>
                        <h6><?php echo changeDate($workout['date']); ?></h6>
                    </div>
                    <div class="icons-container">
                        <a href="update.php?id=<?php echo $workout['id']; ?>"><i class="bi bi-pencil"></i></a>
                        <a href="?action=delete&id=<?php echo $workout['id']; ?>"><i class="bi bi-trash3"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

</body>

</html>