<?php
/**
 * If you drop a pro folder, it creates the pro version for it.
 */
function blank_theme_load_pro()
{
    $file = BLANK_THEME_TEMP_DIR . '/pro/pro.php';

    if ( file_exists($file) )
    {
        define( 'BLANK_THEME_PRO', true );
        require_once $file;
    }
}
add_action( 'blank_theme_after' , 'blank_theme_load_pro' );
