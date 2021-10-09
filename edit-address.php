<?php

// Include required functions and files
require_once('app/initialize.php');

// Return to homapage if no id passed
if(!isset($_GET['id'])){
    header("Location: index.php");
    die();
}

// Get exiting details and fill form
$address = Address::find_by_id($_GET['id']);

$add_id = $address -> id;
$f_name = $address -> first_name;
$l_name = $address -> last_name;
$email = $address -> email;
$street = $address -> street;
$city_n = $address -> city;
$zip = $address -> zip;

/** 
 * "Edit existing address" form handler starts here
 * 
*/
$error = '';
$success = '';

// cheeck if form submitted
if(isset($_POST['f_name'])){
    // Form validation    
    (is_blank_single($_POST['add_id'])==true) ? $error .= "First name is required <br>" : $add_id = $_POST['add_id'];
    (is_blank_single($_POST['f_name'])==true) ? $error .= "First name is required <br>" : $f_name = $_POST['f_name'];
    (is_blank_single($_POST['l_name'])==true) ? $error .= "Last name is required <br>" : $l_name = $_POST['l_name'];
    (is_blank_single($_POST['email'])==true) ? $error .= "Email is required <br>" : $email = $_POST['email'];
    (is_blank_single($_POST['street'])==true) ? $error .= "Street is required <br>" : $street = $_POST['street'];
    (is_blank_single($_POST['city'])==true) ? $error .= "City is required <br>" : $city_n = $_POST['city'];
    (is_blank_single($_POST['zip'])==true) ? $error .= "Zip is required <br>" : $zip = $_POST['zip'];
    // Other advanced form validatins goes here

    // insert data to database (senetization will be done before insert from relavent class function)
    if($error == ''){
        $new_address = new Address();
        $new_address -> id =  $add_id;
        $new_address -> first_name =  $f_name;
        $new_address -> last_name =  $l_name;
        $new_address -> email =  $email;
        $new_address -> street =  $street;
        $new_address -> zip =  $zip;
        $new_address -> city =  $city_n;
        $new_address -> created_at =  date('Y-m-d H:i:s');
        $new_address -> update();
        
        $success .= "Address updated successfully";
    }
}

/** 
 * "Add new address" form handler ends here
 * 
*/

/** 
 * Page contents start here
 * 
*/

// Document title
$site_title = "Update an existing address";
$page = 'address';

// Include site header
include_once( SITE_ROOT . '/theme/header.php' );

// Prepare city from database
$cities = City::find_all();
$opts_add = '<option value="" '. ( !isset($city_n) || $city_n == '' ? 'selected' : '' ) .'>Select your city</option>';
foreach ($cities as $city):
    $opts_add .= "<option value='".$city->id."' ". ( isset($city_n) && $city_n == $city->id ? 'selected' : '' ) .">".$city->city."</option>";
endforeach;

?>

        <h1> edit address </h1>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <div class="success">
            <?php echo $success; ?>
        </div>
        <form method="post" action="">
            <input value="<?php echo (isset($add_id) ? $add_id : ''); ?>" type="hidden" name="add_id" />
            <div class="formData">
                <label> First name </label>
                <input value="<?php echo (isset($f_name) ? $f_name : ''); ?>" type="text" name="f_name" />
            </div>
            <div class="formData">
                <label> Last name </label>
                <input value="<?php echo (isset($l_name) ? $l_name : ''); ?>" type="text" name="l_name" />
            </div>
            <div class="formData">
                <label> Email </label>
                <input value="<?php echo (isset($email) ? $email : ''); ?>" type="email" name="email" />
            </div>
            <div class="formData">
                <label> Street </label>
                <input value="<?php echo (isset($street) ? $street : ''); ?>" type="text" name="street" />
            </div>
            <div class="formData">
                <label> City </label>
                <select name="city">
                    <?php echo $opts_add; ?>
                </select>
            </div>
            <div class="formData">
                <label> Zip code </label>
                <input max="999999" value="<?php echo (isset($zip) ? $zip : ''); ?>" type="number" name="zip" />
            </div>
            <div class="formData">
                <button type="submit"> update address </button>
            </div>
        </form>
        
        <a href="address.php" class="btn-sm"> Back </a>
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