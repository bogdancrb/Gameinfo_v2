<div id="container">
	<h1><?php echo $page_name; ?></h1>

	<!-- TODO Make lang for this -->

	<div id="body">
		<p>
			<?php if (isset($error) && $error): ?>
				<p>
					<?php echo '<div style="color: #E13300">' . $error . '</div>'; ?>
				</p>
			<?php else: ?>
				Published by <b><?php echo anchor('/profile/view/' . $news_author_id, $news_author); ?></b> on <b><?php echo $news_date; ?></b><br>
				Article about <b><?php echo $news_game ?></b>

				<div class="news_content"><?php echo $news_content; ?></div>
				<br>
				------------------------------------------------------------------------------------------------------------
				<h3>Comments</h3> <!-- TODO Make lang for this -->

				<?php if ($news_comments) : ?>
					<?php foreach($news_comments as $id => $comment) : ?>
						<?php echo '#' . ($id + 1) . ' '; ?>
						<?php echo anchor('/profile/view/' . $comment['news_comment_user_id'], $comment['news_comment_user_nickname']); ?> on <?php echo $comment['news_comment_date']; ?> wrote:<br>
						<?php echo $comment['news_comment_content']; ?>
						<br><br>
					<?php endforeach; ?>
				<?php else: ?>
					There are no comments on this news article.
				<?php endif; ?>

				<?php if (isUserLogged()): ?>
					<h3>Write a comment</h3> <!-- TODO Make lang for this -->

					<?php echo form_open(current_url()); ?>
						<?php echo form_error('article[comment]'); ?>
						<textarea name="article[comment]" placeholder="Write down your comment" rows="3" cols="100"><?php
							if (!$form_run): echo set_value('article[comment]'); endif;?></textarea>

						<div><input type="submit" value="Submit" /></div>
					</form>
				<?php endif; ?>
			<?php endif; ?>
		</p>
	</div>
</div>