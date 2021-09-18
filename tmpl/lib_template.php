<?php
global $section;
global $oUser;

?>
<html>
<?php
print_header();
?>
<body class="lib_body">
    <div class="container-fluid gx-0" style="height: auto display: flex">
        <?php
            include SECTION_FOLDER.$section.'.php';
        ?>
    </div>

    <?php
        print_footer();
    ?>
</body>

</html>
<?php
