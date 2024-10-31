<?php
/**
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Arum WordPress theme
 */
get_header(); 

echo do_shortcode('[psw_registration]');
get_footer();?>