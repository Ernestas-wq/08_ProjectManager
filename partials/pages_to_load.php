<?php declare (strict_types = 1) ?>
<?php
function display_results_to_show(int $a, int $b, int $c)
{
    echo '<div class="pageToLoadUI">
    <div class="d-flex flex-column">
    <h5 class="display-6 text-secondary text-left">Results per page</h5>
    <div class="d-flex">
    <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="results_to_show" value="' . $a . '">
    <button type="submit">' . $a . '</button>
    </form>
    <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="results_to_show" value="' . $b . '">
    <button type="submit">' . $b . '</button>
    </form>
    <form method="POST" action="show.php">
    <input type="hidden" name="show" value="y">
    <input type="hidden" name="results_to_show" value="' . $c . '">
    <button type="submit">' . $c . '</button>
    </form>
    </div>
    </div>
    </div>';

}
