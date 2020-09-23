<?php

namespace standard_xml\admin\controllers;

use standard_xml\admin\controllers\file_interface;

class fileXml implements file_interface
{
    protected $dom;

    /**
     * Evento construtor da classe
     *
     * @param string $path
     */
    public function __construct(string $path = null)
    {
        $this->load($path);
    }

    /**
     * Lê o arquivo com o DOMDocument
     *
     * @param string $path
     * @return void
     */
    public function load(string $path = null)
    {
        if(!isset($path)){
            return;
        }

        $this->setDom(new \DOMDocument('1.0', 'utf8'));

        try{
            $this->getDom()->load($path);
            return;
        }
        catch(\Exception $e){
            throw \Exception($e->getMessage());
        }
    }

    /**
     * Devolve o conteúdo do arquivo
     * [interface]
     *
     * @return mixed
     */
    public function content()
    {
        return $this->getDom();
    }

    /**
     * Retorna o nó
     *
     * @param string $tag
     * @return void
     */
    public function get(string $tag)
    {
        return $this->getDom()->getElementsByTagName($tag);
    }

    /**
     * Adiciona item ao nó
     *
     * @param string $tag
     * @param mixed $item
     * @return void
     */
    public function set(string $tag, $item)
    {
        return;
    }

    /**
     * Informa se xml é válido conforme o Schema (xsd)
     *
     * @param object $xsd
     * @return boolean
     */
    public function isValidSchema(string $xsd)
    {
        if(!file_exists($xsd)){
            return false;
        }

        return $this->getDom()->schemaValidate($xsd);
    }

    /**
     * Informa se xml é válido conforme o DTD
     *
     * @param object $xsd
     * @return boolean
     */
    public function isValidDtd()
    {
        return $this->getDom()->validate();
    }

    /**
     * Get the value of dom
     */ 
    private function getDom()
    {
        return $this->dom;
    }

    /**
     * Set the value of dom
     *
     * @return  self
     */ 
    protected function setDom($dom)
    {
        if(isset($dom)){
            $this->dom = $dom;
        }

        return $this;
    }
}