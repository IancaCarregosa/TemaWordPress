<?php get_header(); ?>

<?php if (is_home() || is_front_page()) : ?>
    <!-- Se for a home, incluir o template da home -->
    
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

<?php else : ?>
    <!-- Se não for a home, mostrar listagem simples -->
    <main class="simple-listing">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div><?php the_excerpt(); ?></div>
            </article>
        <?php endwhile; else : ?>
            <p>Nenhum post encontrado.</p>
        <?php endif; ?>
    </main>
<?php endif; ?>

<script>
// Script de pesquisa
document.addEventListener('DOMContentLoaded', function() {
    const searchRecent = document.getElementById('search-recent');
    const searchAll = document.getElementById('search-all');
    
    function filterPosts(searchInput, postsContainer) {
        if (!searchInput) return;
        
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
});
</script>

<?php get_footer(); ?>