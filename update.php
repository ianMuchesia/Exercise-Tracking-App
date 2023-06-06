<?php 
include 'inc/header.php';?>

<h1 class="update-header">Update Page</h1>
    <form action="" class="update-workout">
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
            <input type="button" value="update workout" class="btn">
        </div>
    </form>
</body>
</html>