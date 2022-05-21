<?php

require_once "../controller/functions.php";

$id = $_POST["id"];

$assignedDevice = getPtypeBrands($id);
//print_r($assignedDevice);exit;

if($assignedDevice==1){
    ?>
    <option value="">No Machines in this Type</option>
    <?php

}else{
    ?>
    
    <?php
   
   
    foreach($assignedDevice as $device)
    {
        
        ?>
            <option value="<?php echo $device['id'];?>"><?php echo $device['brand_name'];?></option>
        <?php
    
    }
}






?>