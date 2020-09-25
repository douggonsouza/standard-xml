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
     * Inicia um conteúdo XML com ou sem DTD
     *
     * @param string $dtd
     * @return void
     */
    public function initXML()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';

        $this->setDom(new DOMDocument("1.0", "utf-8"));
        $this->getDom()->loadXML($xml);

        return true;
    }

    /**
     * Devolve o conteúdo do arquivo
     * [interface]
     *
     * @return mixed
     */
    public function content()
    {
        return $this->save();
    }

    /**
     * Retorna o nó
     * 
     *
     * @param string $tag
     * @return void
     */
    public function getElement(string $tag)
    {
        return $this->getDom()->getElementsByTagName($tag);
    }

    /**
     * Adiciona um elemento
     *
     * @param string      $name
     * @param string      $value
     * @param mixed       $fatherElement
     * @param array|null  $attributes
     * @return bool
     */
    public function addElement(string $name, string $value, $fatherElement = null, array $attributes = null)
    {
        if(!isset($name) || empty($name)){
            return false;
        }

        if(!isset($value) || empty($value)){
            return false;
        }

        $dElement = $this->getDom()->createElement($name, $value);
        if(isset($attributes) && !empty($attribues)){
            $dElement = $this->addElementWithAttributes($name, $value, $attributes);
        }

        $add = $dElement;
        if(isset($fatherElement)){
            $add = $fatherElement->appendChild($dElement);
        }

        return $this->getDom()->appendChild($add);
    }

    /**
     * Adiciona um elemento com attributo
     *
     * @param string $element
     * @param mixed  $value
     * @param array  $attributes
     * @return object
     */
    public function addElementWithAttributes(string $element, $value, array $attributes)
    {
        if(!isset($element) || empty($element)){
            return false;
        }

        if(!isset($value) || empty($value)){
            return false;
        }

        if(!isset($attributes) || empty($attributes)){
            return false;
        }

        $dElement   = $this->getDom()->createElement($element, $value);

        foreach($attributes as $attribute => $value){
            $dAttribute = $this->getDom()->createAttribute($attribute);
            $dAttribute->value = $value;
            $add = $dElement->appendChild($dAttribute);
        }

        return $add;
    }

    /**
     * Salva o XML e suas alterações
     *
     * @return string
     */
    public function save()
    {
        return $this->getDom()->saveXML();
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