<?php
$home = '../../index.php';
$views_emp = '../employees/';
$views_proj = ' ../projects/';
echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="'.$home.'">Project Manager</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-between" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="'.$home.'">Home</a>
        </li>

    <li class="nav-item">
    <form action="'. $views_emp .'show.php" method="POST">
            <input type="hidden" name="emp" value="y">
            <button type="submit" class="btn nav-link">All Employees</button>
        </form>
    </li>

    <li class="nav-item">
    <form action="'. $views_proj.'show.php" method="POST">
            <input type="hidden" name="proj" value="y">
            <button type="submit" class="btn nav-link">All Projects</button>
        </form>
    </li>

        <li class="nav-item">
            <a class="nav-link" href="'. $views_emp . 'new.php">Add Employee</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="'. $views_proj . 'new.php">Add Project</a>
        </li>
    </ul>';
    if($_SESSION['logged_in']) {
        echo '<div class=userUI>
        <span class="username">'.$_SESSION['username'].'</span>
        <a class="nav-link" href="../../index.php?action=logout">Logout
        </a>
        </div>';
    }

echo '</div>
</nav>
<main class="container mt-5">';
