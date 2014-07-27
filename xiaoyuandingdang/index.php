<?php
require_once 'inc/all.php';
require_once 'nusoapClient.php';
session_start ();

display_html_header ( "欢迎" );
// display_index_welcome ();
display_carousel ();
display_simple_introduction ();
display_html_footer ();
