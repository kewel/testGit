<?php

/**
 * Clase para la ceración de formularios
 *
 * @author Manel Monteserín Navarro
 */
class creaForm {
        
    /*
     * método para añadir un input de html
     * 
     * $tipo = el valor de type del input
     * $nombre = el valor de name en el input
     * $valor = el valor de value del input
     * 
     * retorna el código en html del input construido 
     */
    public function addInput($tipo,$nombre,$valor){
        return "<input type=$tipo name=$nombre value=$valor >";
    }
    
    /*
     * método para añadir un select de html
     * 
     * $opciones = el número de option que tiene el select
     * $aValues = un array con todos los valores de value (1 por cada option)
     * $aValores = un array con todos los valores que se verán en el option (1 por cada option)
     * 
     * retorna el código html del select construido
     */
    public function addSelect($opciones,$aValues,$aValores){
        $retorno = "<select>";
        for($i=0;$i<$opciones;$i++){
            $retorno .= "<option value=$aValues[$i]>$aValores[$i]</option>";
        }
        $retorno .= "</select>";
        return $retorno;
    }
    
    /*
     * método para añadir una área de texto 
     * 
     * $rows = filas que tendrá el área
     * $columns = columnas que tendrá el área
     * $text = el texto a mostrar
     * $name = el nombre del textarea para el formulario
     * 
     * retorna el código html del textArea contruido
     */
    public function addTextArea($rows,$columns,$text,$nombre){
        return "<textarea rows=$rows cols=$columns name=$nombre style='resize:none'>$text</textarea>";
    }
    
    /*
     * método para añadir un label 
     * 
     * $for = el valor del name del input al que acompaña el label 
     * 
     * retorna el código en html del label construido
     */
    public function addLabelFor($for){
        return "<label for=$for>$for</label>";
    }
    
    /*
     * método para añadir un grupo de radio button
     * 
     * $name = el valor de name 
     * $aValues = un array con los valores de value
     * $aSelected = un array con el radio seleccionado con el valor true (el resto con false)
     * 
     * retorna el código html del grupo de radio buttons
     */
    public function addRadio($name,$aValues,$aSelected){
        $retorno="";
        foreach($aValues as $key=>$value){
            $retorno .= "<input type='radio' name=$name value=$value";
            if($aSelected[$key]==true) $retorno .= " checked ";
            $retorno .= ">$value</input>";
        }
    }
    
    /*
     * método para añadir un checkbox
     * 
     * $nombre = el valor de name del input
     * $valor = el valor de value del input
     * $texto = el texto a mostrar al lado del checkbox
     * 
     */
    public function addCheckBox($nombre,$valor,$texto){
        $retorno="";
        $retorno .= "<input type='checkbox' name=$nombre value=$valor />$texto<br />";
        return $retorno;
    }
    
    public function addCheckBox2($nombre,$check){
        $retorno="";
        $retorno .= "<input type='checkbox' name=$nombre $check /><br />";
        return $retorno;
    }
    /*
     * método para añadir un button
     * 
     * $texto = el texto a mostrar en el botón
     */
    public function addButton($texto){
        return "<button type='button'>$texto</button>";
    }
    
    
}

?>
