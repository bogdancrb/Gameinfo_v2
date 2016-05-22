<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <!-- TODO Make a lang file for the whole page -->

    <div id="body">
        <?php echo $menu; ?>

        <div class="admin_news_add">
            <?php echo anchor('apanel/manage/articles/add','Add News article'); ?>
        </div>
        
        <p>
            <?php if (isset($error) && $error) : ?>
                <?php echo $error; ?>
            <?php else: ?>
            <table class="admin_news_table">
                <tr>
                    <th class="admin_news_title">Article title</th>
                    <th>Author</th>
                    <th>Game</th>
                    <th>Date</th>
                    <th>Options</th>
                </tr>
                <?php foreach ($news_articles as $news_article) : ?>
                    <tr>
                        <td><?php echo $news_article['news_title']; ?></td>
                        <td><?php echo $news_article['news_author']; ?></td>
                        <td><?php echo $news_article['news_game'] ? $news_article['news_game'] : 'None'; ?></td>
                        <td><?php echo $news_article['news_date']; ?></td>
                        <td><?php echo anchor('apanel/manage/articles/edit/'. $news_article['news_id'], 'Options'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </p>
    </div>
</div>