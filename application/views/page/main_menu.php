<!-- TODO Create lang for menu and make this more dynamic -->
<?php echo anchor(index_page(), 'Home'); ?> |
<?php if (isUserLogged() === false) : ?>
    <?php echo anchor('login', 'Login'); ?> |
    <?php echo anchor('register', 'Register'); ?> |
<?php else : ?>
    <?php echo anchor('library', 'My Games'); ?> |
<?php endif; ?>
<?php echo safe_mailto('contact@zenoth.x10.mx', 'Contact'); ?>

<?php if (isUserLogged() === true) : ?>
    <div class="menu_logged_user">
        <?php if (isUserAdmin() === true) : ?>
            <?php echo anchor('apanel', 'Admin Panel'); ?> |
            <?php echo anchor('mpanel', 'Moderator Panel'); ?> |
        <?php endif; ?>
        <?php echo anchor('profile', getUserNickname()); ?> |
        <?php echo anchor('logout', 'Logout'); ?>
    </div>
<?php endif; ?>