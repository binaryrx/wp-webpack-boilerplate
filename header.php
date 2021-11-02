<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="test meta description">
    <link rel="shortcut icon" type="image/ico" href="<?php echo get_template_directory_uri();?>/src/images/favicon.ico"/>
    <title>test title</title>
    <?php wp_head();?>

    <?php the_field('scripts-head', 'option'); ?>

</head>
<script>
    window.template_uri = "<?php echo get_template_directory_uri();?>";
</script>

<?php
    $templateName = str_replace(".php", "", str_replace("templates/template-", "", get_page_template_slug()));
    echo get_page_template_slug();
?>

<body <?php body_class();?> data-template="<?php echo $templateName; ?>">
    <?php the_field('scripts-after-body-tag', 'option'); ?>

    <header class="header">

        <?php 
            $args = [
                "theme_location" => "main",
                "exclude" => get_option('page_on_front')
            ];
            wp_nav_menu($args);
        ?>

    </header>
