<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title><?php echo $site_title .  $page_name; ?></title>

        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

        <?php echo auto_version(link_tag('css/gameinfo.css')); ?>

    </head>

    <body>
        <a href="home">Home</a> |
        <?php if (isUserLogged() === false) : ?>
            <a href="login">Login</a> |
            <a href="register">Register</a> |
        <?php endif ?>
        <a href="sess_controller">*Session vars*</a>
        <!-- TODO Create lang for menu and make this more dynamic -->

        <?php if (isUserLogged() === true) : ?>
            <div class="menu_logged_user">
                <?php if (isUserAdmin() === true) : ?>
                    <a href="#">Admin Panel</a> |
                <?php endif ?>
                <a href="#"><?php echo getUserNickname(); ?></a> |
                <a href="logout">Logout</a>
            </div>
        <?php endif ?>

