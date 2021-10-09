<?php

// Include required functions and files
require_once('app/initialize.php');

/** 
 * Page contents start here
 * 
*/

// Document title
$site_title = "My address book";
$page = 'address';

// Include site header
include_once( SITE_ROOT . '/theme/header.php' );

// Prepare addresses from database
$contents = '';
$contents .= "<div class='address_row'>";
$contents .= "<table>";


$addresses = Address::find_all();

foreach ($addresses as $address):
    $contents .= "<tr>";
    $contents .= "<td>" . $address -> first_name . " " . $address -> last_name . "</td>";
    $contents .= "<td>" . $address -> email . "</td>";
    $contents .= "<td>" . $address -> zip . "</td>";
    
    $city = City::find_by_id($address -> city);
    $contents .= "<td>" . $city -> city . "</td>";
    
    $contents .= "<td> <a class='btn-sm' href='edit-address.php?id=". $address -> id ."'> Edit </a></td>";
    $contents .= "</tr>";
endforeach;

$contents .= "</div>";
$contents .= "</table>";
?>

        <h1> My addresses </h1>     
        <a href="new-address.php" class="formData pull-right"> Add address </a>
        <div class="clear">
            <?php echo $contents; ?>
        </div>
        <div class="pull-right">            
            <a href="export-json.php" class="pull-right"> Export JSON </a>
            <a href="export-xml.php" class="pull-right"> Export XML </a>
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