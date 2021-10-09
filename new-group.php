<?php

// Include required functions and files
require_once('app/initialize.php');

/** 
 * "Add new group" form handler starts here
 * 
*/
$error = '';
$success = '';

// cheeck if form submitted
if(isset($_POST['group_name'])){
    // Form validation    
    (is_blank_single($_POST['group_name'])==true) ? $error .= "Group name is required <br>" : $group_name = $_POST['group_name'];
    (is_blank_single($_POST['group_parent'])==true) ? $error .= "Group parent is required <br>" : $group_parent = $_POST['group_parent'];
    // Other advanced form validatins goes here

    // insert data to database (senetization will be done before insert from relavent class function)
    if($error == ''){
        $new_group = new Group();
        $new_group -> group_name =  $group_name;
        $new_group -> parent_group_id =  $group_parent;
        $new_group -> created_at =  date('Y-m-d H:i:s');
        $new_group -> create();
        
        $success .= "New group added successfully";

        $group_name = $group_parent = false;
    }
}

/** 
 * "Add new group" form handler ends here
 * 
*/

/** 
 * Page contents start here
 * 
*/

// Document title
$site_title = "Add new group";
$page = 'group';

// Include site header
include_once( SITE_ROOT . '/theme/header.php' );

// Prepare group list from database
$dashes = '';
$opts_add = '<option value="0" '. ( !isset($group_parent) || $group_parent == '' ? 'selected' : '' ) .'>Parent itself</option>';
/////// convert all groups into options wth dashed /////////
if(!isset($group_parent)){
    $group_parent = '';
}
$opts_add .= getRlational(0, $group_parent);

?>

        <h1> new group </h1>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <div class="success">
            <?php echo $success; ?>
        </div>
        <form method="post" action="">
            <div class="formData">
                <label> Group name </label>
                <input value="<?php echo (isset($group_name) ? $group_name : ''); ?>" type="text" name="group_name" />
            </div>
            <div class="formData">
                <label> Parent Group </label>
                <select name="group_parent">
                    <?php echo $opts_add; ?>
                </select>
            </div>
            <div class="formData">
                <button type="submit"> Add new group </button>
            </div>
        </form>
        
        <a href="group.php" class="btn-sm"> Back </a>
    </div>
</div>

<?php
// Include site footer
include_once( SITE_ROOT . '/theme/footer.php' );

/** 
 * Page contents ends here
 * 
*/
?>