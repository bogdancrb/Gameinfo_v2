<?php echo form_open('login'); ?>
<h3>Login</h3>

<h5>Username</h5>
<?php echo form_error('username'); ?>
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

<h5>Password</h5>
<?php echo form_error('password'); ?>
<input type="password" name="password" value="" size="50" />

<br><br>

<div><input type="submit" value="Submit" /></div>

</form>