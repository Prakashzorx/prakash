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
$rcpids = [];
$x = 0;
foreach ($result as $row) {
    $rcpids[$x] = $row['rcpid'];
    $x++;
}
for ($i = 1; $i < 11; $i++) {

    // print_r($row);
    // print_r($i);


    if (in_array($i, $rcpids)) {
        //echo "Match found";
    } else {
?>


        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
    }
}


?>