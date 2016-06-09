<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <!-- TODO Make a lang file for the whole page -->

    <div id="body">
        <?php echo $menu; ?>
        <p>
            <?php if (isset($message) && $message) : echo $message; ?>
            <?php elseif (isset($error_message) && $error_message) : ?>
                <?php echo '<div style="color: #E13300">' . $error_message . '</div>'; ?>
            <?php endif; ?>
        </p>
    </div>
</div>

<script>
    $(document).ready(function(){
        window.setTimeout(function() {
            window.location.href = '/gameinfo_v2/apanel/manage/articles'; <!-- TODO Find another implementation for this -->
        }, 5000);
    });
</script>

<!-- If javascript is disabled -->
<noscript>
    <?php header("refresh:5;url=/gameinfo_v2/apanel/manage/articles"); ?> <!-- TODO Find another implementation for this -->
</noscript>