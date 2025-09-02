<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-left">
            <div class="footer-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logoBlog.svg" alt="Icon do quarto escura mente">
        </div>
        </div>
        
        <div class="footer-right">
            <div class="substack-section">
                <p class="substack-text">Acompanhe também no Substack</p>
                <div class="substack-profile">
                    <div class="substack-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar-ianca.jpg" alt="Ianca Carregosa">
                    </div>
                    <div class="substack-info">
                        <span class="substack-name">Quarto escuro, mente acesa</span>
                        <a href="https://quartoescuromenteacesa.substack.com" target="_blank" class="substack-link">@sanguelatino</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p><?php echo date('Y'); ?> | Desenvolvido por Ianca Carregosa</p>
    </div>
</footer>

<script>
// Script para toggle do modo escuro
document.addEventListener('DOMContentLoaded', function() {
    const themeSwitch = document.getElementById('theme-switch');
    const body = document.body;
    
    // Verifica se há preferência salva
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        themeSwitch.checked = true;
    }
    
    // Toggle do tema
    themeSwitch.addEventListener('change', function() {
        if (this.checked) {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>