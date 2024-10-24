<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Todo List</title>
    <link rel="stylesheet" href="css/styles.css"> 
    <script src="js/main.js"></script>
</head>
<body>
    <h1>My Todo List</h1>
    <div id="form">
        <input type="text" placeholder="Add a new task" aria-label="Add a new task" id="task_input" name="task">
        <button onclick="upload()" type="submit">Add</button>
    </div>
    <div id="table"></div>
</body>
</html>