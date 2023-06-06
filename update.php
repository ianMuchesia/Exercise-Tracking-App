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