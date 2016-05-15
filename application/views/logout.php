<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <div id="body">
        <p>
           <?php echo $message; ?>
        </p>
    </div>
</div>

<script>
    $(document).ready(function(){
        window.setTimeout(function() {
            window.location.href = 'home';
        }, 5000);
    });
</script>

<!-- If javascript is disabled -->
<noscript>
    <?php header("refresh:5;url=home"); ?>
</noscript>