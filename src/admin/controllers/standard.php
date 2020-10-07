<?php

namespace standard_xml\admin\controllers;

use standard_xml\admin\controllers\fileXml;

abstract class standard
{
    protected static $file;
    protected static $mime;
    protected static $read;

    const MIME_XML = "text/xml";
   
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
    
        // Lê file
        switch(self::getMime()){
            case self::MIME_XML:
                self::setFile(new fileXml($path));
                // Mime
                self::setMime(self::MIME_XML);
                // isRead
                self::setRead(true);
            break;
            default: self::setRead(false);
        }

        return true;
    }

    /**
     * Inicia o arquivo pelo seu mime
     *
     * @param string $mime
     * @return void
     */
    static public function load(string $mime)
    {
        // Lê file
        switch($mime){
            case self::MIME_XML:
                self::setFile(new fileXml($path));
                // Mime
                self::setMime(self::MIME_XML);
                // isRead
                self::setRead(true);
            break;
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
        return self::$file->content();
    }

    /**
     * Get the value of fileXml
     */ 
    static public function getFile()
    {
        return self::$file;
    }

    /**
     * Set the value of fileXml
     *
     * @return  this
     */ 
    static public function setFile($file)
    {
        if(isset($file)){
            self::$file = $file;
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