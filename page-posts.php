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
<main class="posts-main">
    <section class="posts-hero">
        <div class="container">
            <h1 class="posts-title">Todos os Posts</h1>
            <div class="search-box">
                <input type="text" placeholder="Pesquisar posts..." id="search-posts">
            </div>
        </div>
    </section>
    
    <section class="posts-content">
        <div class="container">
            <div class="posts-grid" id="posts-grid">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $all_posts = new WP_Query(array(
                    'posts_per_page' => 12,
                    'post_status' => 'publish',
                    'paged' => $paged,
                    'orderby' => 'date',
                    'order' => 'DESC'
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
                                
                                <div class="post-overlay">
                                    <div class="post-date">
                                        <?php echo get_the_date('d/m/Y'); ?>
                                    </div>
                                    <div class="post-category">
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo '<span class="category-tag">' . esc_html($categories[0]->name) . '</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="post-card-content">
                                <h3 class="post-card-title"><?php the_title(); ?></h3>
                                <div class="post-card-excerpt">
                                    <?php 
                                    $subtitulo = get_post_meta(get_the_ID(), 'subtitulo', true);
                                    if ($subtitulo) {
                                        echo esc_html($subtitulo);
                                    } else {
                                        echo wp_trim_words(get_the_excerpt(), 20, '...');
                                    }
                                    ?>
                                </div>
                                <div class="post-card-meta">
                                    <span class="post-author">Por <?php the_author(); ?></span>
                                    <span class="post-read-time">• Leitura rápida</span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php 
                    endwhile;
                else :
                ?>
                    <div class="no-posts">
                        <h3>Nenhum post encontrado</h3>
                        <p>Ainda não há posts publicados.</p>
                    </div>
                <?php endif; ?>
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
                        'mid_size' => 2,
                        'type' => 'list'
                    ));
                    ?>
                </div>
            <?php endif; ?>
            
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<script>
// Script de pesquisa
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-posts');
    const postsGrid = document.getElementById('posts-grid');
    
    if (searchInput && postsGrid) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const posts = postsGrid.querySelectorAll('.post-card');
            
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
});
</script>

<?php get_footer(); ?>