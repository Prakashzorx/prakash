
<?php

require_once "../controller/functions.php";

$id = $_POST["id"];

$assignedDevice = getMachineDistinctRctype($id);
//print_r($assignedDevice);exit;

if($assignedDevice==1){
    ?>
    <option value="">No Recipe Type in this Type</option>
    <?php

}else{
    ?>
   
    <?php
  
    foreach($assignedDevice as $device)
    {
       
        ?>
            <option value="<?php echo $device['rcptype']; ?>"><?php echo $device['rcptype']; ?></option>
        <?php
    
    }
}






?>