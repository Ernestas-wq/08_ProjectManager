<?php
session_start();

if(isset($_POST['show']) && $_SESSION['logged_in']) {

    if(isset($_POST['results_to_show'])) {
        $_SESSION['results_to_show_emps'] = $_POST['results_to_show'];
    }
    $RESULTS_TO_SHOW = $_SESSION['results_to_show_emps'];
    // Reseting page count if not next or prev
    if(!$_POST['next'] && !$_POST['prev'] && !$_POST['delete'] && !$_POST['edit']) {
        $_SESSION['employees_offset'] = 0;
    }
    // Incrementing results to show by 10
    if($_POST['next']) {
        $_SESSION['employees_offset'] += $RESULTS_TO_SHOW;
    }
    // Decrementing results to show by 10
    if($_POST['prev']) {
      $_SESSION['employees_offset'] -= $RESULTS_TO_SHOW;
    }
// Logging in to db
    $servername = "localhost";
    $db_name = "ProjectManagerDB";
    if($_SESSION['app_user']){
        $username = "app_user";
        $password = "app";
    }
    else {
        $username = "app_viewer";
        $password = "viewer";
    }
}
else {
    echo '<h2 class="display-6 text-center">Please log in to view employees</h2>';
}
?>
    <?php
    require('../../partials/head.php');
    require('../../partials/navbar.php');
    require('../../partials/search.php');
    require('../../partials/pages_to_load.php');
    require('../../Classes/Employee.php');
    require('../../Classes/EditHelper.php');
    require('../../Classes/CreateHelper.php');
    require('../../Classes/DeleteHelper.php');
    require('../../Classes/ShowHelper.php');
    require('delete.php');
    echo '<h1 class="text-center mt-3 display-3 text-secondary">All Employees</h1>';


    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        display_search_UI_emps();
        display_results_to_show(10, 15, 20);
        # Delete modal to confirm
        if(isset($_POST['delete'])) display_delete_modal($_POST['fullname'], $_POST['delete']);

        # If confirmed deleting from DB
        if(isset($_POST['confirm_delete']) && isset($_POST['emp_id'])) {
            DeleteHelper::delete_emp($conn, $_POST['emp_id']);
            echo '<h4 class="text-center mt-3 display-5">Employee deleted successfully</h4>';
        }

        # Create
        if(isset($_POST['new'])) {
            CreateHelper::create_emp($conn, $_POST['firstname'], $_POST['lastname']);
            echo '<h4 class="text-center mt-3 display-5">Employee added successfully </h4>';

        }

        # Update
        if(isset($_POST['edit'])) {
            EditHelper::edit_emp($conn, $_POST['firstname'], $_POST['lastname'], $_POST['emp_id']);
            echo '<h4 class="text-center mt-3 display-5">Employee updated successfully </h4>';
        }

            $OFFSET = $_SESSION['employees_offset'];
            //Getting min and max values in the current OFFSET to know which id's to display
            $min = ShowHelper::get_min_id_per_page($conn, $RESULTS_TO_SHOW, $OFFSET, "employees");
            $max = ShowHelper::get_max_id_per_page($conn, $RESULTS_TO_SHOW, $OFFSET, "employees");
            // Getting overall max id to know when not to display "next" button
            $max_overall_id = ShowHelper::get_max_overall_id($conn, "employees");
            // Displaying accordingly if search by id
            if($_POST['search_by_id']) {
                $emp_id = $_POST['search_by_id'];
                $stmt = ShowHelper::show_emp_by_id($conn, $emp_id);
            }
            // Displaying accordingly if search by lastname
            else if($_POST['search_by_lastname']) {
                $lastname = $_POST['search_by_lastname'];
                $stmt = ShowHelper::show_emp_by_lastname($conn, $lastname);
            }
            // Show first page by default
            else {
            $stmt = ShowHelper::show_all_emps($conn, $min, $max);
            }
        $employees = [];
        foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
            // Grouping projects to an employee for display purposes
            if (array_key_exists($v['id'], $employees) && $v['project_name']) {
                $employees[$v['id']]->populate_projects($v['project_name']);
            } else {
                $emp = new Employee();
                $emp->set_firstname($v['firstname']);
                $emp->set_lastname($v['lastname']);
                if($v['project_name']) {
                $emp->populate_projects($v['project_name']);
                }
                $employees += [$v['id'] => $emp];
            }
        }
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();

    }
    $conn = null;
    // Visualize retrieved data
    if($employees) {
    echo '<div class="container mt-5 mb-5">
    <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope=col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Projects</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>';

    foreach ($employees as $k => $v) {
        echo '<tr>
        <th scope="row"> ' . $k . ' </th>
        <td> ' . $employees[$k]->get_firstname() . '</td>
        <td> ' . $employees[$k]->get_lastname() . '</td>
        <td> ' . $employees[$k]->get_projects() . '</td>
        <td><form method="POST" action="edit.php">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="firstname" value= '. $employees[$k]->get_firstname() . '>
        <input type="hidden" name="lastname" value= '. $employees[$k]->get_lastname() . '>
        <input type="hidden" name="id" value = '. $k .'>
        <button type="submit" class="btn btn-success">Update </button>
        </form></td>
        <td><form method="POST" action="show.php">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="fullname" value="'.$employees[$k]->get_fullname().'">
        <input type="hidden" name="delete" value="'.$k.'">
        <button type="submmit" class="btn btn-danger">Delete </button>
        </form></td>
        </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
    if($OFFSET === 0&& $max !== $max_overall_id
    && !$_POST['search_by_id'] && !$_POST['search_by_lastname']) {
    echo '<div class="container mb-3 d-flex justify-content-between">
     <div></div>
    <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="next" value="y">
    <button class="btn btn-dark">Next</button>
    </form></div>';
    }
    else if($OFFSET > 0 && $max < $max_overall_id
    && !$_POST['search_by_id'] && !$_POST['search_by_lastname']) {
        echo '<div class="container mb-3 d-flex justify-content-between">
        <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="prev" value="y">
    <button class="btn btn-dark">Previous</button>
    </form>
    <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="next" value="y">
    <button class="btn btn-dark">Next</button>
    </form>
    </div>
        ';
    }
    else if($OFFSET !== 0 && $max === $max_overall_id
    && !$_POST['search_by_id'] && !$_POST['search_by_lastname']){
        echo '<div class="container mb-3 d-flex justify-content-between">
        <form method="POST" action="show.php">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="prev" value="y">
        <button class="btn btn-dark">Previous</button>
        </form>
        <div></div>
        </div>';
    }


}
else {
    echo '<h2 class="display-6 text-center">0 Results </h2>';
}
    ?>
    <?php
    require('../../partials/footer.php');
?>
