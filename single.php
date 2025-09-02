<?php get_header(); ?>
<div class="logo-container">
    <a href="<?php echo home_url(); ?>" class="logo">
        <!-- Logo para modo claro (logo escura no fundo claro) -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logoBlogDark.svg" 
             alt="logo do blog" 
             class="logo-img logo-for-light-mode">
        <!-- Logo para modo escuro (logo clara no fundo escuro) -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logoBlogLight.svg" 
             alt="logo do blog" 
             class="logo-img logo-for-dark-mode">
    </a>
</div>

<main class="single-post-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-post-article">
            
            <!-- Título e subtítulo do post -->
            <header class="post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <p class="post-subtitle"><?php echo get_post_meta(get_the_ID(), 'subtitulo', true); ?></p>
            </header>
            
            <!-- Imagem destacada -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Meta informações -->
            <div class="post-meta">
                <p>Publicado por <?php the_author(); ?> em <?php echo get_the_date('j \d\e F \d\e Y'); ?></p>
            </div>
            
            <!-- Container com padding para o conteúdo principal -->
            <div class="post-content-wrapper">
                <!-- Conteúdo do post -->
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Imagem fixa das estrelinhas -->
                <div class="post-stars-divider">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/estrelinhas.svg" alt="Divisor de estrelas" class="stars-divider">
                </div>
                
                <!-- Botões de compartilhar -->
                <div class="share-buttons">
                    <h3>Gostou? Compartilhe esse post!</h3>
                    <div class="share-icons">
                        <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn telegram" title="Compartilhar no Telegram">
                            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Telegram.svg"></span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn twitter" title="Compartilhar no Twitter">
                            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Twitter.svg"></span>
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="share-btn whatsapp" title="Compartilhar no WhatsApp">
                            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/WhatsApp.svg"></span>
                        </a>
                    </div>
                </div>
            </div>
            
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
