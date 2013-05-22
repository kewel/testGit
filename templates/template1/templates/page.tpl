<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
            <title>{$titulo}</title>
            <meta http-equiv="content-type" 
                    content="text/html;charset=utf-8" />
            <link rel="stylesheet" type="text/css" href="templates/template1/css/style_1.css">
            <link rel="stylesheet" type="text/css" href="templates/template1/css/style.css">
            
            <!-- <link rel="stylesheet" type="text/css" href="templates/template1/css/style1.2.css"> -->
            <script type="text/javascript" src="libraries/jquery/jquery.js"></script>
            <script type="text/javascript" src="libraries/jquery/nav2.0.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#JqueryMenu").navPlugin({
					'itemWidth': 120,
					'itemHeight': 40,
					'navEffect': "slide",
					'speed': 200
                    });
                });
            </script>
    </head>

    <body>
            <div id="header">{$header}</div>
            <!-- <div id="wrap"><div class="content"> -->
            <div id="dropdown" class="mainMenu">{$main_menu}</div>
            <!-- </div></div> -->
            <div id="sideFirst">{$sidebar_first}</div>
            <div id="sideLast">{$sidebar_last}</div>
            <div id="contenedor">
                <div id="content-top">{$content_top}</div>
                <div id="content">{$content}</div>
                <div id="content-bottom">{$content_bottom}</div>
            </div>
        <div id="footer">{$footer}</div>
    </body>
</html>