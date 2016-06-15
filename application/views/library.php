<div id="container">
    <h1><?php echo $page_name; ?></h1>

    <!-- TODO Make a lang file for the whole page -->

    <div id="body">
        <p>
            <table>
                <tr>
                    <td class="games_library_content" valign="top">
                        <h3>Your games library</h3>
                        <div class="games_library">
                            AaAaAA!!! - A Reckless Disregard for Gravity
                            <div class="game_options"><?php echo anchor('', 'Delete'); ?></div>
                        </div>
                    </td>

                    <td valign="top">
                        <h3>Game information</h3>
                        <div class="games_information">
                            <table class="custom_table games_table">
                                <tr>
                                    <th class="games_table_title">Game name:</th>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <th class="games_table_title">Genre:</th>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <th class="games_table_title">Platform:</th>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <th class="games_table_title">Wikipedia URL:</th>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <th class="games_table_title">Image:</th>
                                    <td>Test</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <div class="add_games_button">
                            <button type="button">Add games</button>
                        </div>
                    </td>
                </tr>
            </table>
        </p>
    </div>
</div>