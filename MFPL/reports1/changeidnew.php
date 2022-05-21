<?php
require_once "../controller/recipe_update_functions.php";
// print_r($_POST);
$vid = $_POST["id"];
//print_r($country_id);
$result = getrecpid($vid);
?>
<option value=""></option>
<?php
$i = 0;
$x = 0;
foreach ($result as $row) {
?>


        <option value="<?php echo $row['rcpid']; ?>"><?php echo $row['rcpid']; ?></option>
<?php

   }
?>