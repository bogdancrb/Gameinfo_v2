<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <!--TODO I need to make a lang for all texts-->

    <div id="body">
        <p>
            <?php if (isset($error_message) && $error_message) : ?>
                <?php echo '<div style="color: #E13300">' . $error_message . '</div>'; ?>
            <?php endif; ?>

            <?php echo form_open('login'); ?>

                <h5>Username</h5>
                <?php echo form_error('login[username]'); ?>
                <input type="text" name="login[username]" value="<?php echo set_value('login[username]'); ?>" size="50"/>

                <h5>Password</h5>
                <?php echo form_error('login[password]'); ?>
                <input type="password" name="login[password]" value="" size="50" />

                <br><br>

                <div><input type="submit" value="Submit" /></div>

            </form>
        </p>
    </div>
</div>