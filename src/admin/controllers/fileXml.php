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
        $this->load($path = null);
    }

    /**
     * Lê o arquivo com o DOMDocument
     *
     * @param string $path
     * @return void
     */
    public function load(string $path = null)
    {
        $this->setDom(new \DOMDocument('1.0', 'utf8'));

        if(!isset($path)){
            return;
        }

        try{
            $this->getDom()->load($path);
            return;
        }
        catch(\Exception $e){
            throw \Exception($e->getMessage());
        }
    }

    /**
     * Inicia um conteúdo XML
     *
     * @return string
     */
    public function start()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $this->getDom()->loadXML($xml);

        return $this->save();
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
        $element = $this->getDom()->getElementsByTagName($tag);
        if($element->length == 0){
            return null;
        }

        return $element;
    }

    /**
     * Adiciona um elemento
     *
     * @param string      $name
     * @param mixed|null  $value
     * @param array|null  $attributes
     * @param object|null $fatherElement
     * @return bool
     */
    public function addElement(string $name, $value = null, array $attributes = null, object $fatherElement = null)
    {
        if(!isset($name) || empty($name)){
            return false;
        }

        $dElement = $this->getDom()->createElement($name, $value);
        if(isset($attributes) && !empty($attributes)){
            $dElement = $this->addElementWithAttributes($name, $attributes, $value);
        }

        $add = $dElement;
        if(isset($fatherElement)){
            $fatherElement->appendChild($dElement);
            $add = $fatherElement;
        }

        return $this->getDom()->appendChild($add);
    }

    /**
     * Adiciona um elemento com attributo
     *
     * @param string $element
     * @param array  $attributes
     * @param mixed  $value
     * @return object
     */
    public function addElementWithAttributes(string $element, array $attributes, $value = null)
    {
        if(!isset($element) || empty($element)){
            return false;
        }

        if(!isset($attributes) || empty($attributes)){
            return false;
        }

        $dElement   = $this->getDom()->createElement($element, $value);
        foreach($attributes as $attribute => $value){
            $dAttribute = $this->getDom()->createAttribute($attribute);
            $dAttribute->value = $value;
            $dElement->appendChild($dAttribute);
        }

        return $dElement;
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