<?php declare (strict_types = 1) ?>
<?php
function display_search_UI_emps()
{
    echo '
    <div class="container">
    <h3 class="text-danger display-6 mt-4 text-center" id="searchUiValidationMessage"></h3>
    <form class="login mt-3 validated-form" action="show.php" id="searchByIdForm" method="POST">
    <input type="hidden" name="show" value="y">
    <div class="input-container">
        <input type="number" id="searchById" name="search_by_id" autocomplete="off" required>
        <label for="searchById" class="label-name">
            <span class="content-name">Search employee by id </span>
        </label>
    </div>
    </form>
    <form class="login mt-3 validated-form" action="show.php" id="searchByLastnameForm" method="POST">
    <input type="hidden" name="show" value="y">
    <div class="input-container mb-3">
        <input type="text" id="searchByLastName" name="search_by_lastname" autocomplete="off" required>
        <label for="searchByLastName" class="label-name">
            <span class="content-name">Search employee by lastname
            <span class="input-inner">(NOTE: case sensitive)</span></span>
        </label>
    </div>
</form>
</div>';

}

function display_search_UI_projs()
{
    echo '
    <div class="container">
    <h3 class="text-danger display-6 mt-4 text-center" id="searchUiValidationMessage"></h3>
    <form class="login mt-3 validated-form" action="show.php" id="searchByIdForm" method="POST">
    <input type="hidden" name="show" value="y">
    <div class="input-container">
        <input type="number" id="searchById" name="search_by_id" autocomplete="off" required>
        <label for="username" class="label-name">
            <span class="content-name">Search project by id</span>
        </label>
    </div>
    </form>
    <form class="login mt-3 validated-form" action="show.php" id="searchByNameForm" method="POST">
    <input type="hidden" name="show" value="y">
    <div class="input-container mb-3">
        <input type="text" id="searchByName" name="search_by_name" autocomplete="off" required>
        <label for="searchByName" class="label-name">
            <span class="content-name">Search project by name
            <span class="input-inner">(NOTE: case sensitive)</span></span>
        </label>
    </div>
</form>
</div>';
}
