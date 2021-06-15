<?php
global $section;
?>
<html>
<?php
print_main_header();
?>

<body class="main-template-body">
<div class="container-fluid gx-0">
    <div class="container-fluid gx-0" style="width: 100%">
                    <?php
                        include ROOT_FOLDER.$section.'.php';
                    ?>
    </div>
</div>
        <?php
            print_footer();
        ?>
</body>
</html>
