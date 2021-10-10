<?php

// Include required functions and files
require_once('app/initialize.php');

/** 
 * Page contents start here
 * 
*/

// Document title
$site_title = "All groups";
$page = 'group';

// Include site header
include_once( SITE_ROOT . '/theme/header.php' );

$contents = '';
$contents .= "<div class='address_row'>";
$contents .= "<table>";

$contents .= "<tr>";
$contents .= "<th>Group id</th>";
$contents .= "<th>Group name</th>";
$contents .= "<th>Created</th>";    
$contents .= "<th>Actions</th>";
$contents .= "</tr>";

// Prepare group from database

$groups = Group::find_all();

foreach ($groups as $group):
    $contents .= "<tr>";
    $contents .= "<td>" . $group -> id . "</td>";
    $contents .= "<td>" . $group -> group_name . "</td>";
    $contents .= "<td>" . $group -> created_at . "</td>";    
    $contents .= "<td> <a class='btn-sm' href='view-group.php?id=". $group -> id ."'> View </a> <a class='btn-sm' href='edit-group.php?id=". $group -> id ."'> Edit </a></td>";
    $contents .= "</tr>";
endforeach;

$contents .= "</div>";
$contents .= "</table>";
?>

        <h1> Groups </h1>     
        <a href="new-group.php" class="formData pull-right"> Add group </a>
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