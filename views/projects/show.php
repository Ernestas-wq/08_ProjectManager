<?php
session_start();

if (isset($_POST['show']) && $_SESSION['logged_in']) {
    # Results to show
    if (isset($_POST['results_to_show'])) {
        $_SESSION['results_to_show_projs'] = $_POST['results_to_show'];
    }
    $RESULTS_TO_SHOW = $_SESSION['results_to_show_projs'];

    // Reseting page count if not next or prev
    if (!$_POST['next'] && !$_POST['prev'] && !$_POST['delete'] && !$_POST['edit']
        && !$_POST['assign']) {
        $_SESSION['projects_offset'] = 0;
    }
    // Incrementing results to show by 10
    if ($_POST['next']) {
        $_SESSION['projects_offset'] += $RESULTS_TO_SHOW;
    }
    // Decrementing results to show by 10
    if ($_POST['prev']) {
        $_SESSION['projects_offset'] -= $RESULTS_TO_SHOW;
    }

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
require '../../Classes/Project.php';
require '../../Classes/ShowHelper.php';
require '../../Classes/EditHelper.php';
require '../../Classes/CreateHelper.php';
require '../../Classes/DeleteHelper.php';
require 'delete.php';

echo '<h1 class="text-center mt-3 display-3 text-secondary">All Projects</h1>';

display_search_UI_projs();
display_results_to_show(5, 10, 15);

if (!$_SESSION['logged_in']) {
    echo '<h2 class="display-6 text-center">Please log in to view projects</h2>';
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Getting the neccessary parameters for next and previous
    $OFFSET = $_SESSION['projects_offset'];
    $min = ShowHelper::get_min_id_per_page($conn, $RESULTS_TO_SHOW, $OFFSET, "projects");
    $max = ShowHelper::get_max_id_per_page($conn, $RESULTS_TO_SHOW, $OFFSET, "projects");
    $max_overall_id = ShowHelper::get_max_overall_id($conn, "projects");

} catch (PDOException $e) {
    // echo 'Error: ' . $e->getMessage();
    error_message("Failed connecting to database");
}

# Delete modal to confirm
if ($_POST['delete']) {
    display_delete_modal($_POST['project_name'], $_POST['delete']);
}

# If confirmed deleting from DB

if (isset($_POST['confirm_delete']) && isset($_POST['proj_id'])) {
    try {
    DeleteHelper::delete_proj($conn, $_POST['proj_id']);
    echo '<h4 class="text-center mt-3 display-5">Proejct
            <span class="font-italic font-weight-light">"' . $_POST['project_name'] . '"</span>
            deleted successfully</h4>';
    }
      catch(PDOException $e) {
        error_message("User unauthorized to do this command");
    }
}

if (isset($_POST['new'])) {
    try {
    if ($_POST['project_name']) {
        CreateHelper::create_proj($conn, $_POST['project_name']);
        echo success_message('Proejct <span class="font-italic font-weight-light">"
    ' . $_POST['project_name'] . '"</span> added successfully');
    } else {
        error_message("Project must have a name");
    }
}
  catch(PDOException $e) {
        error_message("User unauthorized to do this command");
    }
}

if (isset($_POST['edit'])) {
    try{
    if ($_POST['project_name']) {
        EditHelper::edit_proj_name($conn, $_POST['project_name'], $_POST['proj_id']);
        success_message('Proejct ' . $_POST['project_name'] . '
            updated successfully');
    } else {
        error_message("Couldn't update project name to nothing");
    }
}
  catch(PDOException $e) {
        error_message("User unauthorized to do this command");
    }

}

# Assign employee to a project by fullname
if ($_POST['assign_by_fullname']) {
    try {
        $emp_id = ShowHelper::get_emp_id_by_fullname($conn, $_POST['firstname'], $_POST['lastname']);
        EditHelper::assign_emp_to_proj($conn, $emp_id, $_POST['proj_id']);
        echo '<h4 class="text-center mt-3 display-5">Employee ' . $_POST['firstname'] . " " .
            $_POST['lastname'] . ' assigned to ' . $_POST['project_name'] . ' successfully
             </h4>';
    }
      catch(PDOException $e) {
        error_message("User unauthorized to do this command");
    }
    catch (Throwable $e) {
        error_message("Employee by this name and lastname doesn't exist");
    }
}
# Assign employee to a project by id
// if ($_POST['assign_by_id']) {
//     $proj_id = $_POST['proj_id'];
//     $emp_id = $_POST['emp_id'];
//     EditHelper::assign_emp_to_proj($conn, $emp_id, $proj_id);
//     echo '<h4 class="text-center mt-3 display-5">Employee with id ' . $_POST['emp_id'] .
//         ' assigned to ' . $_POST['project_name'] . ' successfully
//          </h4>';
// }

// Display by id

if ($_POST['search_by_id']) {
    try {
        $proj_id = $_POST['search_by_id'];
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = ShowHelper::show_proj_by_id($conn, $proj_id);
    } catch (Throwable $e) {
        error_message("No project by this id");
    }
}
// Display by project name

elseif ($_POST['search_by_name']) {
    try {
        $proj_name = $_POST['search_by_name'];
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = ShowHelper::show_proj_by_name($conn, $proj_name);
    } catch (Throwable $e) {
        error_message("No project by this name");
    }
}
// Showing all by default
else {
    try {
        $stmt = ShowHelper::show_all_projs($conn, $min, $max);
    } catch (Throwable $e) {
        error_message("Couldn't retrieve data");
    }
}
$projects = [];
if ($stmt) {
    foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
        $fullname = $v['firstname'] . " " . $v['lastname'];

        // Grouping employees to a project, for display purposes
        if (array_key_exists($v['id'], $projects)) {
            $projects[$v['id']]->populate_employees($fullname);
        } else {
            $p = new Project();
            $p->set_project_name($v['project_name']);
            if ($fullname) {
                $p->populate_employees($fullname);
            }
            $projects += [$v['id'] => $p];
        }
    }
}
$conn = null;

if ($projects) {
    echo '<div class="container mt-5 mb-5">
    <table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope=col">Name</th>
        <th scope="col">Employees</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        <th scope="col" style="width: 170px">Assign Employee</th>
        </tr>
        </thead>
        <tbody>';

    foreach ($projects as $k => $v) {
        echo '<tr>
        <th scope="row"> ' . $k . ' </th>
        <td> ' . $projects[$k]->get_project_name() . '</td>
        <td> ' . $projects[$k]->get_employees() . '</td>
        <td><form method="POST" action="edit.php">
        <input type="hidden" name="edit" value="y">
        <input type="hidden" name="project_name" value="' . $projects[$k]->get_project_name() . '">
        <input type="hidden" name="proj_id" value = ' . $k . '>
        <button type="submit" class="btn btn-success">Update</button>
        </form></td>
        <td><form method="POST" action="show.php">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="project_name" value="' . $projects[$k]->get_project_name() . '">
        <input type="hidden" name="delete" value="' . $k . '">
        <button type="submmit" class="btn btn-danger">Delete </button>
        </form></td>
        <td><form class="d-flex justify-content-center" method="POST" action="assign.php">
        <input type="hidden" name="assign" value="y">
        <input type="hidden" name="project_name" value="' . $projects[$k]->get_project_name() . '">
        <input type="hidden" name="id" value = ' . $k . '>
        <button type="submit" class="btn btn-warning">Assign</button>

        </form>
        </td>

        </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
    if ($OFFSET === 0 && $max !== $max_overall_id) {
        echo '<div class="container mb-3 d-flex justify-content-between">
         <div></div>
        <form method="POST" action="show.php">
        <input type="hidden" name="show" value="y">
        <input type="hidden" name="next" value="y">
        <button class="btn btn-dark">Next</button>
        </form></div>';
    } elseif ($OFFSET > 0 && $max < $max_overall_id) {
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
    } elseif ($OFFSET !== 0 && $max === $max_overall_id) {
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
    echo '<h2 class="display-6 text-center">0 Results</h2>';
}
?>
    <?php
require '../../partials/footer.php';
?>