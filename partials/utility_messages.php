<?php declare (strict_types = 1) ?>
<?php
function error_message(string $msg) {
    echo '<h4 class="text-center text-danger display-5">'.$msg.'</h4>';
}
function success_message(string $msg) {
   echo  '<h4 class="text-center mt-3 display-5">'.$msg.'</h4>';
}

?>