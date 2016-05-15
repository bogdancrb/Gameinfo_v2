<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <div id="body">
        <?php if (isset($error) && $error): ?>
            <p><?php echo $error; ?></p>
        <?php else: ?>
            {news_articles}
            <h3>{news_title}</h3>
            Published by <b><a href="profile/view/{news_author_id}">{news_author}</a></b> on <b>{news_date}</b><br>
            Article about <b>{news_game}</b>
            <p>
                {news_content}
                <br><br>
                <a href="news/read/{news_id}">Read more</a> <!-- TODO Make lang for this -->
                <br><br>
                ------------------------------------------------------------------------------------------------------------
            </p>
            {/news_articles}
        <?php endif ?>
    </div>
</div>