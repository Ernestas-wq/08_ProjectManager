<?php
session_start();

if (isset($_POST['show']) && $_SESSION['logged_in']) {

    if (isset($_POST['results_to_show'])) {
        $_SESSION['results_to_show_emps'] = $_POST['results_to_show'];
    }
    $RESULTS_TO_SHOW = $_SESSION['results_to_show_emps'];
    // Reseting page count if not next or prev
    if (!$_POST['next'] && !$_POST['prev'] && !$_POST['delete'] && !$_POST['edit']) {
        $_SESSION['employees_offset'] = 0;
    }
    // Incrementing results to show by 10
    if ($_POST['next']) {
        $_SESSION['employees_offset'] += $RESULTS_TO_SHOW;
    }
    // Decrementing results to show by 10
    if ($_POST['prev']) {
        $_SESSION['employees_offset'] -= $RESULTS_TO_SHOW;
    }
// Logging in to db
    $servername = "localhost";
    $db_name = "ProjectManagerDB";
    if ($_SESSION['app_user']) {
        $username = "app_user";
        $password = "app";
    } else {
        $username = "app_viewer";
        $password = "viewer";
    }
}
?>
    <?php
require '../../partials/head.php';
require '../../partials/navbar.php';
require '../../partials/search.php';
require '../../partials/pages_to_load.php';
require '../../partials/utility_messages.php';
require '../../Classes/Employee.php';
require '../../Classes/EditHelper.php';
require '../../Classes/CreateHelper.php';
require '../../Classes/DeleteHelper.php';
require '../../Classes/ShowHelper.php';

require 'delete.php';
echo '<h1 class="text-center mt-3 display-3 text-secondary">All Employees</h1>';

if (!$_SESSION['logged_in']) {
    error_message("Please log in to view employees");
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Getting min and max values in the current OFFSET to know which id's to display
    $OFFSET = $_SESSION['employees_offset'];
    $min = ShowHelper::get_min_id_per_page($conn, $RESULTS_TO_SHOW, $OFFSET, "employees");
    $max = ShowHelper::get_max_id_per_page($conn, $RESULTS_TO_SHOW, $OFFSET, "employees");

    // Getting overall max id to know when not to display "next" button
    $max_overall_id = ShowHelper::get_max_overall_id($conn, "employees");

} catch (PDOException $e) {
    // echo "Error: " . $e->getMessage();
    error_message("Failed connecting to database");
}

display_search_UI_emps();
display_results_to_show(10, 15, 20);
# Delete modal to confirm
if (isset($_POST['delete'])) {
    display_delete_modal($_POST['fullname'], $_POST['delete']);
}

# If confirmed deleting from DB
if (isset($_POST['confirm_delete']) && isset($_POST['emp_id'])) {
    DeleteHelper::delete_emp($conn, $_POST['emp_id']);
    success_message('Employee <span class="font-italic font-weight-light">
        ' . $_POST['fullname'] . '</span> deleted successfully');
}

# Create
if (isset($_POST['new'])) {
    if ($_POST['firstname'] && $_POST['lastname']) {
        CreateHelper::create_emp($conn, $_POST['firstname'], $_POST['lastname']);
        success_message('<span class="font-italic font-weight-light">
            ' . $_POST['firstname'] . " " . $_POST['lastname'] . '
            </span>added successfully ');
    } else {
        error_message("Employee must have first and lastname to be added");
    }

}

# Update
if (isset($_POST['edit'])) {
    EditHelper::edit_emp($conn, $_POST['firstname'], $_POST['lastname'], $_POST['emp_id']);
    echo '<h4 class="text-center mt-3 display-5">Employee
            <span class="font-italic font-weight-light">
            ' . $_POST['firstname'] . " " . $_POST['lastname'] . '
            </span>
            updated successfully</h4>';
}

# Assign
if (isset($_POST['assign_emp_to_proj'])) {
    try {
        $proj_id = ShowHelper::get_proj_id_by_name($conn, $_POST['project_name']);
        EditHelper::assign_proj_to_emp($conn, $_POST['emp_id'], $proj_id);
    } catch (Throwable $e) {
        error_message("Project by this name doesn't
        exist or employee already assigned to this project");
    }

}

$OFFSET = $_SESSION['employees_offset'];
//Getting min and max values in the current OFFSET to know which id's to display

// Displaying accordingly if search by id
if ($_POST['search_by_id']) {
    try {
        $emp_id = $_POST['search_by_id'];
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = ShowHelper::show_emp_by_id($conn, $emp_id);
    } catch (Throwable $e) {
        error_message("No employee by this id");
    }
}
// Displaying accordingly if search by lastname
elseif ($_POST['search_by_lastname']) {
    try {
        $lastname = $_POST['search_by_lastname'];
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = ShowHelper::show_emp_by_lastname($conn, $lastname);
    } catch (Throwable $e) {
        error_message("No employee by this lastname");
    }
}
// Show first page by default
else {
    try {
        $stmt = ShowHelper::show_all_emps($conn, $min, $max);
    } catch (Throwable $e) {
        error_message("Couldn't retrieve data");
    }
}
$employees = [];
if ($stmt) {
    foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
        // Grouping projects to an employee for display purposes
        if (array_key_exists($v['id'], $employees) && $v['project_name']) {
            $employees[$v['id']]->populate_projects($v['project_name']);
        } else {
            $emp = new Employee();
            $emp->set_firstname($v['firstname']);
            $emp->set_lastname($v['lastname']);
            if ($v['project_name']) {
                $emp->populate_projects($v['project_name']);
            }
            $employees += [$v['id'] => $emp];
        }
    }
}
$conn = null;
// Visualize retrieved data
if ($employees) {
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
        <th scope="col" style="width: 170px">Assign project </th>
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
        <input type="hidden" name="firstname" value= ' . $employees[$k]->get_firstname() . '>
        <input type="hidden" name="lastname" value= ' . $employees[$k]->get_lastname() . '>
        <input type="hidden" name="id" value = ' . $k . '>
        <button type="submit" class="btn btn-success">Update </button>
        </form></td>
        <td><form method="POST" action="show.php">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="fullname" value="' . $employees[$k]->get_fullname() . '">
        <input type="hidden" name="delete" value="' . $k . '">
        <button type="submmit" class="btn btn-danger">Delete </button>
        </form></td>
        <td><form class="d-flex justify-content-center" method="POST" action="assign.php">
        <input type="hidden" name="assign" value="y">
        <input type="hidden" name="fullname" value="' . $employees[$k]->get_fullname() . '">
        <input type="hidden" name="id" value = ' . $k . '>
        <button type="submit" class="btn btn-warning">Assign</button>
        </form></td>
        </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
    if ($OFFSET === 0 && $max !== $max_overall_id
        && !$_POST['search_by_id'] && !$_POST['search_by_lastname']) {
        echo '<div class="container mb-3 d-flex justify-content-between">
     <div></div>
    <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="next" value="y">
    <button class="btn btn-dark">Next</button>
    </form></div>';
    } elseif ($OFFSET > 0 && $max < $max_overall_id
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
    } elseif ($OFFSET !== 0 && $max === $max_overall_id
        && !$_POST['search_by_id'] && !$_POST['search_by_lastname']) {
        echo '<div class="container mb-3 d-flex justify-content-between">
        <form method="POST" action="show.php">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="prev" value="y">
        <button class="btn btn-dark">Previous</button>
        </form>
        <div></div>
        </div>';
    }

} else {
    echo '<h2 class="display-6 text-center">0 Results </h2>';
}
?>
    <?php
require '../../partials/footer.php';
?>
