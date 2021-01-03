<?php
$home = '../../index.php';
$views_emp = '../employees/';
$views_proj = ' ../projects/';
echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">Project Manager</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="'.$home.'">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="'. $views_emp .'employees.php">All Employees</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="'. $views_proj . 'projects.php">All Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="'. $views_emp . 'new.php">Add Employee</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="'. $views_proj . 'new.php">Add Project</a>
        </li>

    </ul>
</div>
</nav>
<main class="container mt-5">

';