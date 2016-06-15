<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <!-- TODO Make a lang file for the whole page -->

    <div id="body">
        <p>
            <table class="custom_table_width games_content">
                <tr>
                    <td class="games_library_content" valign="top">
                        <h3>Games in library</h3>
                        <?php if (isset($message) && $message): echo $message; ?>
                        <?php else: ?>
                            <div class="games_library">
                                <?php foreach($library_games as $game): ?>
                                        <?php echo anchor('library/view/' . $game['game_id'], $game['game_name']); ?>
                                        <div class="game_options"><?php echo anchor('', 'Delete'); ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </td>

                    <td valign="top">
                        <h3>Game information</h3>
                        <div class="games_information">
                            <?php if (isset($error) && $error): ?>
                                <?php echo '<div style="color: #E13300">' . $error . '</div>'; ?>
                            <?php else: ?>
                                <table class="custom_table_width custom_table games_table">
                                    <tr>
                                        <th class="games_table_title">Game name:</th>
                                        <td><?php echo $game_details['game_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Platform:</th>
                                        <td><?php echo $game_details['game_platform']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Image:</th>
                                        <td>
                                            <?php if ($game_details['game_image']): ?>
                                                <img src="<?php echo base_url() . GAME_IMG_FOLDER ?><?php echo $game_details['game_image']; ?>"/>
                                            <?php else: ?>
                                                <?php echo '-'; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Genre:</th>
                                        <td><?php echo $game_details['game_genre']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Wikipedia URL:</th>
                                        <td><?php echo anchor($game_details['game_wikiurl'], $game_details['game_wikiurl']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Description:</th>
                                        <td><?php echo $game_details['game_description'] ? $game_details['game_description'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Trailer:</th>
                                        <td>
                                            <?php if ($game_details['game_trailer']) : ?>
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo str_replace(
                                                    'https://www.youtube.com/watch?v=',
                                                    '',
                                                    $game_details['game_trailer']) ?>" frameborder="0" allowfullscreen></iframe>
                                            <?php else: ?>
                                                <?php echo '-'; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Operating system:</th>
                                        <td><?php echo $game_details['game_os_req']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">CPU:</th>
                                        <td><?php echo $game_details['game_cpu_req']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">RAM:</th>
                                        <td><?php echo $game_details['game_ram_req']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Video card:</th>
                                        <td><?php echo $game_details['game_video_req']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="games_table_title">Game deals:</th>
                                        <td style="font-style: italic;">In future releases here will be added links to deals of the selected game.
                                            This will be done with web crawlers.
                                        </td>
                                    </tr>
                                </table>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <div class="add_games_button">
                            <button type="button">Add game</button>
                        </div>
                    </td>
                </tr>
            </table>
        </p>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.add_games_button').on('click', function(){
            $("html, body").animate({ scrollTop: 0 }, "slow");
            var gamesLibrary = $('.games_library');
            var gamesLibraryContent = gamesLibrary.html();

            $.ajax({
                url: "<?php echo base_url() . 'library/add'; ?>",
                async: false,
                dataType: 'html',
                success: function(data){
                    console.log(data);
                    gamesLibrary.html(data);
                }
            });
        });
    });
</script>