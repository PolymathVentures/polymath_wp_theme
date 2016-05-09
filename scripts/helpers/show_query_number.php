<?php

function wpse_footer_db_queries(){
    echo '<!-- '.get_num_queries().' queries in '.timer_stop(0).' seconds. -->'.PHP_EOL;
}

add_action('wp_footer', 'wpse_footer_db_queries');