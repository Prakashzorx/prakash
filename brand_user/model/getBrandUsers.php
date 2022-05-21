<?php

require_once "../controller/functions.php";











$id = $_POST["id"];

$brandusers = getBrandUsers($id);
//print_r($brandusers);exit;
if($brandusers==false){
    ?>
    <option value="">No Users in this brand</option>
    <?php

}else{
    ?>
    <option value="" selected></option>
    <?php

    foreach ($brandusers as $row) {

        ?>
            <option value="<?php echo $row['user_id']; ?>"><?php echo $row["name"]; ?></option>
        <?php
        }
        
}






?>