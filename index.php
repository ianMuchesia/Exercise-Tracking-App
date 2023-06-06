<?php 
include 'inc/header.php';

?>


<?php 
//Form submit
    $title = $loadLifted =$reps = '';
    $titleErr = $loadLiftedErr=$repsErr='';


   
    if(isset($_POST['submit'])){

        //validate TITLE
        if(empty($_POST['title'])){
            $titleErr = 'Title is required';
        }else{
            $title = filter_input(INPUT_POST, 'title', 
            FILTER_SANITIZE_SPECIAL_CHARS);
        }

        //VALIDATE LOAD
        if(empty($_POST['loadLifted'])){
            $loadLiftedErr = 'Load Lifted is required';
        }else{
            $loadLifted = filter_input(INPUT_POST, 'loadLifted', 
            FILTER_SANITIZE_NUMBER_INT);
        }

        //validate reps
        if(empty($_POST['reps'])){
            $repsErr = 'Reps is required';

        }else{
            $reps = filter_input(INPUT_POST,'reps', 
            FILTER_SANITIZE_NUMBER_INT);
        }

        if(empty($titleErr) && empty($loadLiftedErr) && empty($repsErr)){
            $sql = "INSERT INTO feedback (title, loadLifted,reps) VALUES('$title','$loadLifted','$reps')";

            if(!mysqli_query($conn, $sql)){
                echo "Error: ". mysqli_error($conn);
            }
        }
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
                    <input type="text" class="input-workout <?php $titleErr?"input-error":null; ?>" name="title" value="<?php echo $title; ?>">
                    <p class="error-message"><?php echo $titleErr;?></p>
                </div>
                <div class="load-container">
                    <label for="load">Load in Kgs</label>
                    <input type="number" name="loadLifted" id="load" class="input-workout <?php $loadLiftedErr?"input-error":null; ?>" value="<?php echo $loadLifted; ?>">
                    <p class="error-message"><?php echo $loadLiftedErr;?></p>
                </div>
                <div class="reps-container">
                    <label for="reps">Reps Taken</label>
                    <input type="number" name="reps" id="reps"  class="input-workout <?php $repsErr?"input-error":null; ?>" value="<?php echo $reps; ?>">
                    <p class="error-message"><?php echo $repsErr;?></p>
                </div>
                <div class="submit-container">
                    <input type="submit" name="submit" value="Add Workout" class="btn">
                </div>
            </form>
        </div>
    <div class="workouts">
        <h2>Workouts</h2>
        <div class="workouts-container">
            <div class="workout-card">
                <div class="details-container">
                    <h4>title</h4>
                    <h5>Load in Kg</h5>
                    <h5>Number of Reps</h5>
                    <h6>Date</h6>
                </div>
                <div class="icons-container">
                    <i class="bi bi-pencil"></i>
                    <i class="bi bi-trash3"></i>
                </div>
            </div>
            
        </div>
    </div>
    </main>

</body>
</html>