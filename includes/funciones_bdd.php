<?php



function getContent($get){
    
    if(isset($get['p'])){
        $que = $get['p'];
        //echo $que;
        switch($que){
            case "admin":
                return "admin";
                break;
            
            case "afegir":
                $contenido = "";
                
                $contenido .= mostrarFormVacio();
                
                return $contenido;
                break;
            case "editar":
                $contenido = "";
                
                $contenido .= mostrarFormLleno($get['row']);
                
                return $contenido;
                break;
            case "editarContenido":
                
                if(isset($_POST['Títol']) && isset($_POST['Url']) && isset($_POST['Contingut'])){
                    if($_POST['Títol']!="" && $_POST['Url']!=""){
                        editarContenido($_POST);
                    }
                }
                
                $contenido = "<h2>Listat de Contingut</h2><br /><br />";
                $contenido .= "<a href='index.php?p=afegir'>Afegir Contingut</a><br/>";
                $contenido .= listarContenido();
                
                return $contenido;
                
                break;
            case "afegirNou":
                //comprovar campos
                if(isset($_POST['Títol']) && isset($_POST['Url']) && isset($_POST['Contingut'])){
                    if($_POST['Títol']!="" && $_POST['Url']!=""){
                        //echo "entra";
                        anyadirContenido($_POST);
                    }
                }
                
            case "contenido":
                $contenido = "<h2>Listat de Contingut</h2><br /><br />";
                $contenido .= "<a href='index.php?p=afegir'>Afegir Contingut</a><br/>";
                $contenido .= listarContenido();
                
                return $contenido;
                break;
            
            case "mostrar":
                $contenido = buscarHtml($_GET['id']);
                
                return $contenido;
                break;
            default:
                return "Pàgina no trobada.";
                break;
        }
        
    }else{
        //indice
        return "";
    }
}

?>
