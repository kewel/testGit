<!-- <!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html> -->
<?php
//load Smarty library
require_once('libraries/smarty/libs/Smarty.class.php');
require_once('modules/menu/listarMenus.php');
require_once('includes/project_includes.php');

$smarty = new Smarty;
$smarty->template_dir = 'templates/template1/templates/';
$smarty->compile_dir = 'templates/template1/templates_c/';
$smarty->config_dir = 'templates/template1/configs/';
$smarty->cache_dir = 'templates/template1/cache/';

//$resultado = "";// = '<ul id="JqueryMenu">';
//ponHijos(0, 1, $resultado);
$menu = "<ul id='JqueryMenu'>
                <li><a class='amenu' href='index.php'>Index</a></li>
                <li><a class='amenu' href='index.php?p=admin'>Admin</a></li>
                <li><a class='amenu' href='index.php?p=contenido'>Contenido</a></li>
                <li><a class='amenu' href='' >Blocs</a></li>
                <li><a class='amenu' href='' >Usuarios</a></li>
              </ul>";

$resultado = getContent($_GET);

$smarty->assign('titulo','TÍTULO');
$smarty->assign('header','HEADER');
$smarty->assign('main_menu',$menu);
$smarty->assign('sidebar_first','Sidebar First');
$smarty->assign('sidebar_last','SIDEBAR LAST');
$smarty->assign('content_top','CONTENT TOP');
$smarty->assign('content',$resultado);
$smarty->assign('content_bottom','CONTENT BOTTOM');
$smarty->assign('footer','FOOTER');
$smarty->display('page.tpl');
?>