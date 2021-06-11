<?php
global $section;
?>
<html>
<?php
print_main_header();
?>

<body class="main-template-body">
<div class="container-fluid gx-0">
    <div class="container-fluid justify-content-md-center gx-0" style="width: 100%">
        <span class="align-middle text-center">
                    <?php
                        include ROOT_FOLDER.$section.'.php';
                    ?>
        </span>
    </div>
</div>
        <?php
            print_footer();
        ?>
</body>
</html>
