<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    
<div class="content">
    <div class="wrapper">
        <div class="navigation">
            <a class="<?php echo ($page == 'group' ? 'active' : '') ?>" href="group.php">groups</a>
            <a class="<?php echo ($page == 'address' ? 'active' : '') ?>" href="address.php">Addresses</a>
        </div>