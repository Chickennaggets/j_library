<?php
global $section;
global $oUser;

?>
    <html>
<?php
print_header();
?>
<body>
<div class="page">
    <div class="parent">

        <?php
            if($oUser->isLogin())
                print_nav_menu();
            ?>

        <div class="p_navigator">
            <?php
                include ROOT_FOLDER.$section.'.php';
            ?>
        </div>
    </div>
    <?php
        print_footer();
    ?>
</div>
</body>
    </html>
<?php
