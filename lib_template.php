<?php
global $section;
global $oUser;

?>
    <html>
<?php
print_header();
?>
<body>
    <div class="container-fluid gx-0" style="min-height: 90vh; display: flex">
        <?php
        include ROOT_FOLDER.$section.'.php';
        ?>
    </div>




    <?php
    print_footer();
    ?>
</body>

    </html>
<?php
