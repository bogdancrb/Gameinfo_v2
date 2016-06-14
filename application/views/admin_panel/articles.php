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
                        <td><?php echo anchor('news/read/' . $news_article['news_id'], $news_article['news_title']); ?></td>
                        <td><?php echo anchor('profile/view/' . $news_article['news_author_id'], $news_article['news_author']); ?></td>
                        <td><?php echo $news_article['news_game'] ? $news_article['news_game'] : 'None'; ?></td>
                        <td><?php echo $news_article['news_date']; ?></td>
                        <td>
                            <a href="javascript:void(0)" class="menu_options" data-id="<?php echo $news_article['news_id'];?>">
                                Options
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </p>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(window).resize(function(){
            if ($('.popup').is('*'))
            {
                $('.popup').remove();
            }
        });

        $('.menu_options').on('click', function(){
            var top = $(this).position().top;
            var left = $(this).position().left;
            var newsID = $(this).attr('data-id');

            $('.popup').remove();

            $('body').append('<div class="popup">' +
                            '<a href="articles/edit/'+ newsID +'">Edit</a> | ' +
                            '<a href="articles/remove/'+ newsID +'">Delete</a>' +
                            '</div>');

            $('.popup').css({
                'position': 'absolute',
                'top':      top + 20 + 'px',
                'left':     left - 30 + 'px'
            });
        });

        $(document).on('click', function(event){
            var sourceElement = event.target.classList[0];

            if ($('.popup').is('*') && sourceElement != 'menu_options')
            {
                $('.popup').remove();
            }
        });
    });
</script>