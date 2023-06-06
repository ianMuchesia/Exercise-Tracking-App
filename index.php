<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h3>Tracking App</h3>
    </header>
    <main>
        <div class="left">
        <div class="illustration">
            <img src="images/Exercise.png" alt="exercie image">
        </div>
       
            <form action="" class="add-workout">
                <div class="exercise-container">
                    <label for="exercise">Exercise Title</label>
                    <input type="text" class="input-workout">
                </div>
                <div class="load-container">
                    <label for="load">Load in Kgs</label>
                    <input type="number" name="load" id="load" class="input-workout">
                </div>
                <div class="reps-container">
                    <label for="reps">Reps Taken</label>
                    <input type="number" name="reps" id="reps"  class="input-workout">
                </div>
                <div class="submit-container">
                    <input type="button" value="Add Workout" class="btn">
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