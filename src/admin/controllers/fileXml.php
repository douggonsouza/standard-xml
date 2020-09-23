<?php

namespace standard_xml\admin\controllers;

use standard_xml\admin\controllers\file_interface;

class fileXml implements file_interface
{
    protected $xml;

    public function load(string $path)
    {
        return;
    }

    /**
     * Retorna o nó
     *
     * @param string $node
     * @return void
     */
    public function get(string $node)
    {
        return;
    }

    /**
     * Adiciona item ao nó
     *
     * @param string $node
     * @param mixed $item
     * @return void
     */
    public function set(string $node, $item)
    {
        return;
    }

    /**
     * Informa se xml é válido conforme o schema
     *
     * @param object $xsd
     * @return boolean
     */
    static public function isValid(object $xsd)
    {
        return;
    }

    /**
     * Devolve o conteúdo do arquivo
     * [interface]
     *
     * @return mixed
     */
    public function content()
    {
        return;
    }

    /**
     * Get the value of xml
     */ 
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * Set the value of xml
     *
     * @return  self
     */ 
    public function setXml($xml)
    {
        if(isset($xml)){
            $this->xml = $xml;
        }

        return $this;
    }
}