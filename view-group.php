<?php

// Include required functions and files
require_once('app/initialize.php');

// Return to homapage if no id passed
if(!isset($_GET['id'])){
    header("Location: index.php");
    die();
}
$error = '';
$msg = '';
// delete address and group relation. Address will be remain in my_addresses table
if(isset($_GET['del'])){
    $relation = $database->query("SELECT * FROM `relation_address_group` where `address_id` = {$_GET['del']} AND `group_id` = {$_GET['id']} LIMIT 1");
    if($database->num_rows($relation) > 0){            
        $relation = $database->fetch_array($relation);
        if ($realtion = Group_address_relation::find_by_id($relation['id'])) {
            $realtion->delete();
            $msg = "Successfully Deleted";
        } else {
            $error = "This realtion is not exists anymore";
        }
    }
}

$group = Group::find_by_id($_GET['id']);
$group_id = $_GET['id'];
$group_name = $group -> group_name;

/** 
 * Page contents start here
 * 
*/


// Document title
$site_title = "Addresses for group " . $group_name;
$page = 'address';

// Include site header
include_once( SITE_ROOT . '/theme/header.php' );

$contents = '';
$contents .= "<div class='address_row'>";
$contents .= "<table>";

$contents .= "<tr>";
$contents .= "<th>Full name</th>";
$contents .= "<th>Email</th>";
$contents .= "<th>Zip</th>";

$contents .= "<th>City</th>";

$contents .= "<th>Actions</th>";
$contents .= "</tr>";

// Prepare addresses from database
$realtions =  Group_address_relation::find_by_group($group_id);

foreach($realtions as $realtion){
    
    $address = Address::find_by_id( $realtion -> address_id );

    $contents .= "<tr>";
    $contents .= "<td>" . $address -> first_name . " " . $address -> last_name . "</td>";
    $contents .= "<td>" . $address -> email . "</td>";
    $contents .= "<td>" . $address -> zip . "</td>";
    
    $city = City::find_by_id($address -> city);
    $contents .= "<td>" . $city -> city . "</td>";
    
    $contents .= "<td> <a class='btn-danger btn-sm' href='view-group.php?id=" . $group_id . "&del=" . $address -> id . "'> Delete </a> <a class='btn-sm' href='edit-address.php?id=". $address -> id ."'> Edit </a></td>";
    $contents .= "</tr>";    
}

$relatinal_address = get_rlational_address($group_id);

foreach ($relatinal_address as $address_id){

    $address = Address::find_by_id($address_id);
    $contents .= "<tr>";
    $contents .= "<td>" . $address -> first_name . " " . $address -> last_name . "</td>";
    $contents .= "<td>" . $address -> email . "</td>";
    $contents .= "<td>" . $address -> zip . "</td>";
    
    $city = City::find_by_id($address -> city);
    $contents .= "<td>" . $city -> city . "</td>";
    
    $contents .= "<td> <a class='btn-sm' href='edit-address.php?id=". $address -> id ."'> Edit </a></td>";
    $contents .= "</tr>";
    
}

$contents .= "</div>";
$contents .= "</table>";
?>

        <h1> addresses for group  <?php echo $group_name; ?></h1> 
        
        <div class="text-left">      
            <a href="group.php" class="btn-sm"> Back </a>
            <a href="new-address.php" class="pull-right mt-0"> Add address </a>
        </div> 
        
        <div class="error">
            <?php echo $error; ?>
        </div>
        <div class="success">
            <?php echo $msg; ?>
        </div>

        <div class="clear">
            <?php echo $contents; ?>
        </div>
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