<?php

require_once "../controller/functions.php";











$id = $_POST["id"];

$brandusers = getBrandStores($id);
//print_r($brandusers);exit;
if($brandusers==false){
    ?>
    <option value="">No Stores in this brand</option>
    <?php

}else{

    ?>
    <option value="" selected></option>
    <?php

    foreach ($brandusers as $row) {

        ?>
         
            <option value="<?php echo $row['id']; ?>"><?php echo $row["store_name"]; ?></option>
        <?php
        }
        
}






?>