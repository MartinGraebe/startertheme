<?php ?>

</main>

<footer class="footer">
    <?php
    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    ?>
    <a  class="to-the-top" aria-label="to the top" href="<?php echo esc_url($current_url) ?>/#top" title="nach oben"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg></a>
    <?php if ( is_active_sidebar( 'generic_widget_location' ) ) { dynamic_sidebar( 'generic_widget_location' ); } ?> <!-- widget location -->
</footer>
<?php wp_footer(); ?>
</body>
</html>
