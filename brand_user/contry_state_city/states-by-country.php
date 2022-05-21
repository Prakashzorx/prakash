<?php
require_once '../controller/functions.php';
//print_r($_POST);
$country_id = $_POST["country_id"];
//print_r($country_id);
$result = getStates($country_id);
?>
<option value=""></option>
<?php
foreach ($result as $row) {
    //print_r($result);
?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
<?php
}
?>
