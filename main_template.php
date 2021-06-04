<?php
global $section;
?>
<html>
<?php
print_main_header();
?>

<body class="info_body">

            <?php
                include ROOT_FOLDER.$section.'.php';
            ?>

        <?php
            print_footer();
        ?>
</body>
</html>
