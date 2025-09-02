<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="main-header">
    <div class="header-top">
        
        <!-- Toggle do tema no canto superior direito -->
        <div class="theme-toggle">
            <input type="checkbox" id="theme-switch" class="theme-switch-checkbox">
            <label for="theme-switch" class="theme-switch-label">
                <span class="theme-switch-inner"></span>
                <span class="theme-switch-switch"></span>
            </label>
        </div>
    </div>
    
    <!-- Navbar abaixo da logo -->
    <nav class="main-nav">
        <div class="nav-links">
            <a href="<?php echo home_url(); ?>">Home</a>
            <a href="<?php echo home_url('/sobre'); ?>">Sobre</a>
            <a href="<?php echo home_url('/posts'); ?>">Posts</a>
        </div>
    </nav>
    
</header>

<!-- Background com estrelas -->
<div class="stars-background">
    <div class="star" style="left: 10%; top: 15%;"></div>
    <div class="star" style="left: 85%; top: 25%;"></div>
    <div class="star" style="left: 25%; top: 40%;"></div>
    <div class="star" style="left: 70%; top: 60%;"></div>
    <div class="star" style="left: 15%; top: 75%;"></div>
    <div class="star" style="left: 90%; top: 80%;"></div>
    <div class="star" style="left: 45%; top: 90%;"></div>
    <div class="star" style="left: 60%; top: 30%;"></div>
    <div class="star" style="left: 5%; top: 50%;"></div>
    <div class="star" style="left: 80%; top: 10%;"></div>
</div>