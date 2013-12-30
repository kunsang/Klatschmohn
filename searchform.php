<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="field" name="s" id="s" value="<?php echo (get_search_query()) ? get_search_query() : __r('Search')  ?>" default-value="<?php echo esc_attr(__r('Search')); ?>" />
</form>
<script>
    jQuery(document).ready(function() {
        jQuery("#s").ThemeFocusing();
    });
</script>