<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title><?php echo $site_title .  $page_name; ?></title>

        <script
            src="https://code.jquery.com/jquery-2.2.3.min.js"
            integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
            crossorigin="anonymous">
        </script>

        <?php echo auto_version(link_tag('css/gameinfo.css')); ?>

    </head>

    <body>
        <!-- TODO Create lang for menu and make this more dynamic -->
        <a href="home">Home</a> |
        <?php if (isUserLogged() === false) : ?>
            <a href="login">Login</a> |
            <a href="register">Register</a> |
        <?php else : ?>
            <a href="#">My Games</a> |
        <?php endif ?>
        <a href="mailto:contact@zenoth.x10.mx">Contact</a>

        <?php if (isUserLogged() === true) : ?>
            <div class="menu_logged_user">
                <?php if (isUserAdmin() === true) : ?>
                    <a href="#">Admin Panel</a> |
                    <a href="sess_controller">*Session vars*</a> |
                <?php endif ?>
                <a href="#"><?php echo getUserNickname(); ?></a> |
                <a href="logout">Logout</a>
            </div>
        <?php endif ?>

