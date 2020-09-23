<?php

namespace standard_xml\admin\controllers;

use standard_xml\admin\controllers\fileXml;

abstract class standard
{
    static $fileXml;
    
    /**
     * Lê o arquivo através da classe para o tipo
     *
     * @param string $path
     * @return void
     */
    static public function read(string $path)
    {
        if(!file_exists($path)){
            return false;
        }

        $mine = mime_content_type($path);
        // switch($mime){
        //     case '':
        //         self->setFileXml(new filePath($path));
        //     break;
        //     default:
        // }
        return;
    }

    /**
     * Devolve o conteúdo do arquivo
     * [interface]
     *
     * @return mixed
     */
    static public function content()
    {
        return;
    }

    /**
     * Get the value of fileXml
     */ 
    static public function getFileXml()
    {
        return self->$fileXml;
    }

    /**
     * Set the value of fileXml
     *
     * @return  self
     */ 
    static public function setFileXml($fileXml)
    {
        if(isset($fileXml)){
            self->$fileXml = $fileXml;
        }
    }
}