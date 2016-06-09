        <?php echo $site_copyright; ?>

        <!-- TODO Move all tech data to a separate view controller -->
        <?php if (isUserAdmin() === true) : ?>
            <h2>Session data</h2>
            <pre class="admin_session_data"><?php echo var_dump($this->session->all_userdata()); ?></pre>

            <h2>Post data</h2>
            <pre class="admin_post_data"><?php echo var_dump($this->input->post()); ?></pre>

            <h2>Get data</h2>
            <pre class="admin_get_data"><?php echo var_dump($this->input->get()); ?></pre>
        <?php endif; ?>

    </body>

</html>
