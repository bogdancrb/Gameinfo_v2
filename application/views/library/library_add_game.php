<?php echo form_open(base_url() . 'library/add'); ?>
	<table>
		<tr>
			<td>Platform:</td>
			<td>
				<?php echo form_dropdown('library[platform]', $game_titles, set_value('library[platform]')); ?>
			</td>
		</tr>
		<tr>
			<td>Game:</td>
			<td>
				<?php echo form_dropdown('library[game]', $game_titles, set_value('library[game]')); ?>
			</td>
		</tr>
	</table>

	<div><input type="submit" value="Submit" /></div>
</form>