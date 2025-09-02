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

<!-- Hero dinâmico com post mais recente -->
<?php
$latest_post = new WP_Query(array(
    'posts_per_page' => 1,
    'post_status' => 'publish'
));

if ($latest_post->have_posts()) :
    while ($latest_post->have_posts()) : $latest_post->the_post();
    $hero_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : get_template_directory_uri() . '/assets/images/default-hero.jpg';
    $subtitulo = get_post_meta(get_the_ID(), 'subtitulo', true);
?>
<section class="hero-section" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-text">
            <h1 class="hero-title"><?php the_title(); ?></h1>
            <?php if ($subtitulo) : ?>
                <p class="hero-subtitle"><?php echo esc_html($subtitulo); ?></p>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="hero-btn">
                <span class="btn-icon">→</span>
                <span class="btn-text">LEIA O MAIS RECENTE</span>
            </a>
        </div>
        <div class="hero-visual">
            <!-- Elemento decorativo opcional -->
        </div>
    </div>
</section>
<?php 
    endwhile;
    wp_reset_postdata();
endif;
?>

<main class="home-main">
    
    <!-- Seção de Posts Recentes -->
    <section class="recent-posts-section">
        <div class="section-header">
            <h2 class="section-title">RECENTS POSTS</h2>
            <div class="search-box">
                <input type="text" placeholder="Pesquisar..." id="search-recent">
            </div>
        </div>
        
        <div class="posts-grid">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <article class="post-card">
                    <a href="<?php the_permalink(); ?>" class="post-card-link">
                        <div class="post-card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-post.jpg" alt="Imagem padrão">
                            <?php endif; ?>
                        </div>
                        
                        <div class="post-card-content">
                            <h3 class="post-card-title"><?php the_title(); ?></h3>
                            <div class="post-card-excerpt">
                                <?php 
                                $subtitulo = get_post_meta(get_the_ID(), 'subtitulo', true);
                                if ($subtitulo) {
                                    echo esc_html($subtitulo);
                                } else {
                                    echo wp_trim_words(get_the_excerpt(), 15, '...');
                                }
                                ?>
                            </div>
                        </div>
                    </a>
                </article>
            <?php 
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>
    
    <!-- Seção de Todos os Posts -->
    <section class="all-posts-section">
        <div class="section-header">
            <h2 class="section-title">ALL POSTS</h2>
            <div class="search-box">
                <input type="text" placeholder="Pesquisar..." id="search-all">
            </div>
        </div>
        
        <div class="posts-grid" id="all-posts-grid">
            <?php
            $all_posts = new WP_Query(array(
                'posts_per_page' => 9,
                'post_status' => 'publish',
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
            ));
            
            if ($all_posts->have_posts()) :
                while ($all_posts->have_posts()) : $all_posts->the_post();
            ?>
                <article class="post-card">
                    <a href="<?php the_permalink(); ?>" class="post-card-link">
                        <div class="post-card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-post.jpg" alt="Imagem padrão">
                            <?php endif; ?>
                        </div>
                        
                        <div class="post-card-content">
                            <h3 class="post-card-title"><?php the_title(); ?></h3>
                            <div class="post-card-excerpt">
                                <?php 
                                $subtitulo = get_post_meta(get_the_ID(), 'subtitulo', true);
                                if ($subtitulo) {
                                    echo esc_html($subtitulo);
                                } else {
                                    echo wp_trim_words(get_the_excerpt(), 15, '...');
                                }
                                ?>
                            </div>
                        </div>
                    </a>
                </article>
            <?php 
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <!-- Paginação -->
        <?php if ($all_posts->max_num_pages > 1) : ?>
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $all_posts->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'prev_text' => '← Anterior',
                    'next_text' => 'Próximo →',
                ));
                ?>
            </div>
        <?php endif; ?>
    </section>
    
</main>

<script>
// Script de pesquisa simples
document.addEventListener('DOMContentLoaded', function() {
    const searchRecent = document.getElementById('search-recent');
    const searchAll = document.getElementById('search-all');
    
    function filterPosts(searchInput, postsContainer) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const posts = postsContainer.querySelectorAll('.post-card');
            
            posts.forEach(post => {
                const title = post.querySelector('.post-card-title').textContent.toLowerCase();
                const excerpt = post.querySelector('.post-card-excerpt').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    }
    
    // Aplicar filtro nas seções
    if (searchRecent) {
        const recentGrid = document.querySelector('.recent-posts-section .posts-grid');
        filterPosts(searchRecent, recentGrid);
    }
    
    if (searchAll) {
        const allGrid = document.querySelector('.all-posts-section .posts-grid');
        filterPosts(searchAll, allGrid);
    }

    // ===========================================
    // FUNCIONALIDADE DO TOGGLE DE TEMA E LOGO
    // ===========================================
    
    // Elementos
    const themeToggle = document.querySelector('.theme-switch-checkbox');
    const body = document.body;
    const logoForLightMode = document.querySelector('.logo-for-light-mode'); // Logo escura
    const logoForDarkMode = document.querySelector('.logo-for-dark-mode');   // Logo clara
    
    // Verificar se há preferência salva no localStorage
    const savedTheme = localStorage.getItem('theme');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    
    // Função para aplicar o tema
    function applyTheme(isDark) {
        if (isDark) {
            // Modo escuro: mostrar logo clara, esconder logo escura
            body.classList.add('dark-mode');
            logoForLightMode.style.display = 'none';
            logoForDarkMode.style.display = 'block';
            if (themeToggle) themeToggle.checked = true;
        } else {
            // Modo claro: mostrar logo escura, esconder logo clara
            body.classList.remove('dark-mode');
            logoForLightMode.style.display = 'block';
            logoForDarkMode.style.display = 'none';
            if (themeToggle) themeToggle.checked = false;
        }
    }
    
    // Definir tema inicial
    if (savedTheme) {
        applyTheme(savedTheme === 'dark');
    } else {
        // Se não há preferência salva, usar a preferência do sistema
        applyTheme(prefersDarkScheme.matches);
    }
    
    // Event listener para o toggle
    if (themeToggle) {
        themeToggle.addEventListener('change', function() {
            const isDark = this.checked;
            applyTheme(isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }
    
    // Listener para mudanças na preferência do sistema
    prefersDarkScheme.addEventListener('change', function(e) {
        if (!localStorage.getItem('theme')) {
            applyTheme(e.matches);
        }
    });
});
</script>

<?php get_footer(); ?>