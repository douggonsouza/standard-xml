<?php

namespace standard_xml\admin\controllers;

use standard_xml\admin\controllers\fileXml;

abstract class standard
{
    protected static $fileXml;
    protected static $mime;
    protected static $read;
    
    /**
     * Lê o arquivo através da classe para o tipo
     *
     * @param string $path
     * @return void
     */
    static public function read(string $path)
    {
        if(!file_exists($path)){
            self::setRead(false);
            return false;
        }

        // Mime
        self::setMime(mime_content_type($path));
    
        // Lê file
        switch(self::getMime()){
            case "text/xml": self::setFileXml(new fileXml($path)); self::setRead(true); break;
            default: self::setRead(false);
        }

        return true;
    }

    /**
     * O arquivo foi lido ou não
     *
     * @return boolean
     */
    static public function isRead()
    {
        return self::getRead();
    }

    /**
     * Transforma array de configs em xml
     *
     * @param array       $configs
     * @param string|null $xsd
     * @return string
     */
    static public function parseXml(array $configs, string $xsd = null)
    {
        return string;
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
        return self::$fileXml;
    }

    /**
     * Set the value of fileXml
     *
     * @return  this
     */ 
    static public function setFileXml($fileXml)
    {
        if(isset($fileXml)){
            self::$fileXml = $fileXml;
        }
    }

    /**
     * Get the value of mime
     */ 
    static public function getMime()
    {
        return self::$mime;
    }

    /**
     * Set the value of mime
     *
     * @return  self
     */ 
    static public function setMime($mime)
    {
        if(isset($mime)){
            self::$mime = $mime;
        }
    }

    /**
     * Get the value of read
     */ 
    static public function getRead()
    {
        return self::$read;
    }

    /**
     * Set the value of read
     *
     * @return  self
     */ 
    public function setRead($read)
    {
        if(isset($read)){
            self::$read = $read;
        }
    }
}