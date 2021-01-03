<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1 class="text-center mt-5 display-1 text-primary">Project Manager</h1>
    <div class="container mt-5">
        <form action="views/employees/employees.php" method="POST">
            <div class="container d-flex align-items-center justify-content-center">
                <input type="hidden" name="emp" value="y">
                <button class="btn btn-info">Employees</button>
            </div>
        </form>
        <form action="views/projects/projects.php" method="POST" class="mt-5">
            <div class="container d-flex align-items-center justify-content-center">
                <input type="hidden" name="proj" value="y">
                <button class="btn btn-success align-center">Projects</button>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>