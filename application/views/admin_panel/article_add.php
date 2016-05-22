<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <!-- TODO Make a lang file for the whole page -->

    <div id="body">
        <?php echo $menu; ?>
        <p>
            <?php if (isset($message) && $message) : echo $message; ?>
            <?php else : ?>
                <?php echo form_open(current_url()); ?>

                    <h5>Article title</h5>
                    <?php echo form_error('article[title]'); ?>
                    <input type="text" name="article[title]" value="<?php echo set_value('article[title]'); ?>" size="50" />

                    <h5>Article about</h5>
                    <?php if (isset($error_message) && $error_message) : ?>
                        <?php echo '<div style="color: #E13300">' . $error_message . '</div>'; ?>
                    <?php endif; ?>
                    <?php echo form_dropdown('article[game]', $game_titles, set_value('article[game]')); ?>

                    <h5>Content</h5>
                    <?php echo form_error('article[content]'); ?>
                    <textarea name="article[content]" placeholder="Write the news article." rows="30" cols="100"><?php
                        echo set_value('article[content]'); ?></textarea>

                    <br><br>

                        <div><input type="submit" value="Submit" /></div>

                </form>
            <?php endif; ?>
        </p>
    </div>
</div>