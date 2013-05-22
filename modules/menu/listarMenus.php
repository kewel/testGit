<?php

function db_connect() {

    $mysqli = new mysqli("localhost", "root", "zero3726T", "test");
    if ($mysqli->connect_errno) {
        echo("Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }
    //echo $mysqli->host_info . "\n";
    return $mysqli;
}

//método para crear un array con los menús de la base de datos

function ponHijos($parent, $mid, &$resultado) {

    $db = db_connect();
    $result = $db->query('SELECT * FROM menus WHERE pid="' . $parent . '" AND mid="' . $mid . '" ORDER BY peso;');
    
    //echo $result->num_rows;
    if (($result->num_rows) > 0) {
        if ($resultado == "") {
            $resultado .= '<ul id="JqueryMenu">';
        } else {
            $resultado .= '<ul>';
        }
        while ($row = mysqli_fetch_array($result)) {

            $resultado .= '<li><a href="#">' . $row['nombre'] . "</a>";

            ponHijos($row['iid'], $mid, $resultado);
        }
        $resultado .= '</li>';
        $resultado .= '</ul>';
        
    }
}

/*
 * método para crear un array con el contenido de la base de datos
 */
function listarContenido(){
    
    $db = db_connect();
    $result = $db->query('SELECT * FROM contenido ORDER BY cId;');
    
    //echo $result->num_rows;
    $resultado = "<table id='tablaContenido'><tr><th class='thContenido'>CID</th><th class='thContenido'>Títol</th><th class='thContenido'>URL</th><th class='thContenido'>Publicitat</th><th class='thContenido'>Operacions</th></tr>";
    if (($result->num_rows) > 0) {
         while ($row = mysqli_fetch_array($result)) {
             
             $resultado .= "<tr><td class='tdContenido publi'> ".$row['cId']."</td><td class='tdContenido'><a href='index.php?p=mostrar&id=" . $row['cId'] . "'> ".$row['titulo']."</a></td><td class='tdContenido'> ".$row['url']."</td><td class='tdContenido publi'>";
             if($row['publicado']=='1'){
                 $resultado .="TRUE";
             }else{
                 $resultado .="FALSE";
             }
             $resultado .="</td><td class='botonesDerecha'><a href='index.php?p=editar&row=".$row['cId']."'>Editar </a><a href=''> Eliminar</a></td></tr>";
         }
    }
    $resultado .= "</table>";
    return $resultado;
}

/*
 * método para mostrar un formulario vacío de contenido
 */
function mostrarFormVacio(){
    
    $objForm = new creaForm();
    
    $resultado = "<form action='index.php?p=afegirNou' method='POST' class='formulario'><fieldset><legend>Nou Contingut</legend>";
    $resultado .= $objForm->addLabelFor("Títol")."<br />";
    $resultado .= $objForm->addInput("text","Títol","")."<br />";
    $resultado .= $objForm->addLabelFor("Url")."<br />";
    $resultado .= $objForm->addInput("text", "Url", "")."<br />";
    $resultado .= $objForm->addLabelFor("Contingut")."<br />";
    $resultado .= $objForm->addTextArea(10, 95, "", 'Contingut')."<br />";
    $resultado .= $objForm->addLabelFor("Publicat")."<br />";
    $resultado .= $objForm->addCheckBox("Publicat", "1", "");
    $resultado .= $objForm->addInput("submit","submit", "NOU")."</fieldset></form>";
    return $resultado;
}

/*
 * método para mostrar un formulario lleno de contenido
 */
function mostrarFormLleno($cId){
    
    $db = db_connect();
    $result = $db->query("SELECT * FROM contenido WHERE cId=$cId;");
    $resultado = "";
    
    if($result->num_rows>0){
        $row = mysqli_fetch_array($result);
        
        $objForm = new creaForm();

        $resultado = "<form action='index.php?p=editarContenido' method='POST' class='formulario'><fieldset><legend>Nou Contingut</legend>";
        $resultado .= $objForm->addLabelFor("Títol")."<br />";
        $resultado .= $objForm->addInput("text","Títol",$row['titulo'])."<br />";
        $resultado .= $objForm->addLabelFor("Url")."<br />";
        $resultado .= $objForm->addInput("text", "Url", $row['url'])."<br />";
        $resultado .= $objForm->addLabelFor("Contingut")."<br />";
        $resultado .= $objForm->addTextArea(10, 95, $row['contenido'],'Contingut')."<br />";
        $resultado .= $objForm->addLabelFor("Publicat")."<br />";
        
        /*------------------------------------- TODO --------------------------------------------*/
        //$bool = 0;
        if($row['publicado']){
            //$bool = 1;
            $resultado .= $objForm->addCheckBox2("Publicat", "checked");
        }else{
            $resultado .= $objForm->addCheckBox2("Publicat", "");
        }
        
        $resultado .= $objForm->addInput("submit","submit", "EDITAR");
        $resultado .= $objForm->addInput("hidden", "cId", $cId)."</fieldset></form>";
        
    }
    return $resultado;
}

function anyadirContenido($post){
    
    $db=db_connect();
    $bool = 0;
    if(isset($post['Publicat'])){
        $bool = 1;
    }
    $query = "INSERT INTO contenido (titulo,url,contenido,publicado) VALUES ('" .
                                mysql_escape_string($post['Títol']) . "', 
                              '" .
                                mysql_escape_string($post['Url']) . "' ,
                              '" .
                                mysql_escape_string($post['Contingut']) . "' ,
                              '" .
                                $bool
                              . "');";
    //echo $query;
    if ($aResult = $db->query($query)){
        
    }else {
        
        echo "falla";
    }
}

function editarContenido($post){
    
    $db=db_connect();
    $bool = 0;
    if(isset($post['Publicat'])){
        $bool = 1;
    }
    $query = "UPDATE contenido SET titulo = '" .
                                mysql_escape_string($post['Títol']) . "', 
                              url = '" .
                                mysql_escape_string($post['Url']) . "' ,
                              contenido = '" .
                                mysql_escape_string($post['Contingut']) ."' ,
                              publicado = '" .
                                $bool . "' 
                              WHERE cid = '" .
                                mysql_escape_string($post['cId']) . "';";
    //echo $query;
    if($aResult = $db->query($query)){
        
    }else{
        echo "falla";
    }
}

function buscarHtml($cId){
    
    $db=db_connect();
    
    $query = "SELECT contenido FROM contenido WHERE cId=" . mysql_escape_string($cId) ." AND Publicado = 1;";
    //echo $query;
    $aResult = $db->query($query);
    $contenido = "";
    if($aResult->num_rows>0){
        $row = mysqli_fetch_array($aResult);
        $contenido = $row['contenido'];
    }else{
        $contenido = "<h1>No està publicat.</h1>";
    }
    
    $contenido .= "<br /><br /><a href='index.php?p=contenido'>Tornar</a>";
    return $contenido;
}

?>