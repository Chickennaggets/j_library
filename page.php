<?php
global $section;
?>
    <html>
<?php
print_header();
?>
    <body>
    <table>
        <tr>
            <td class="l_panel" valign="top">
                <?php
                print_nav_menu();
                ?>
            </td>
            <td class="r_panel" valign="top">
                <div class="p_navigator" style="width: auto;">
                    <?php
                        include ROOT_FOLDER.$section.'.php';
                    ?>
                </div>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?php
