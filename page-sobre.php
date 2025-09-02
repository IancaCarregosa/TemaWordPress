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
<main class="sobre-main">
    <section class="sobre-hero">
        <div class="container">
            <h1 class="sobre-title">Porque quarto escuro, mente acesa?</h1>
        </div>
    </section>
    
    <section class="sobre-content">
        <div class="container">
            <div class="sobre-text">
                <p>Desde que me entendo por gente, sou uma pessoa que deita e pensa demais, sobre tudo ou sobre nada, sobre o que já aconteceu e o que ainda pode (ou não) acontecer. Quando o quarto escurece, minha mente se acende, querendo conversar sobre mil coisas: cultura pop, música, séries, psicologia, comportamento social... o que for. Talvez seja um nome bobinho com jogo de palavras mais bobinho ainda, mas combina com a proposta.<br> <br>Este blog é o lugar onde esses pensamentos noturnos ganham forma. Um espaço sem pressa (ou quase) para despejar ideias que resistem ao sono. Não há cronograma rígido, só a urgência de traduzir o que me atravessa quando o resto do planeta dorme.<br> <br>Originalmente nasci no Substack, mas precisei de um cantinho com meu próprio jeito — menos engessado, mais eu. Se quiser receber tudo direto no e-mail, assine a newsletter por lá. Mas fique à vontade para ler aqui, no aconchego do meu canto digita<p>
            </div>
        </div>
        
    </section>
    <section class="divisor">
        <div class="post-stars-divider">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/estrelinhas.svg" alt="Divisor de estrelas" class="stars-divider">
            </div>
    </section>
    
</main>

<?php get_footer(); ?>