<?php echo form_open('register'); ?>
<h3>Register</h3>

<h5>Username</h5>
<?php echo form_error('register[username]'); ?>
<input type="text" name="register[username]" value="<?php echo set_value('register[username]'); ?>" size="50" />

<h5>Password</h5>
<?php echo form_error('register[password]'); ?>
<input type="password" name="register[password]" value="" size="50" />

<h5>Password Confirm</h5>
<?php echo form_error('register[passconf]'); ?>
<input type="password" name="register[passconf]" value="" size="50" placeholder="SKIP THIS" readonly="readonly"/>

<h5>Email Address</h5>
<?php echo form_error('register[email]'); ?>
<input type="text" name="register[email]" value="<?php echo set_value('register[email]'); ?>" size="50" />

<h5>Country</h5>
<?php echo form_error('register[country]'); ?>
<input type="text" name="register[country]" value="<?php echo set_value('register[country]'); ?>" size="50" />

<br><br>

<div><input type="submit" value="Submit" /></div>

</form>