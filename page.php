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
            <td style="width: 180px;" valign="top">
                <?php
                print_nav_menu();
                ?>
            </td>
            <td valign="top" style="width: 80%;">
                <div class="p_navigator" style="width: 100%;">
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
