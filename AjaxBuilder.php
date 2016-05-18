<?php

/******************************************************************
 * Project name: Multi Purpose use jQuery (or javascript ) Ajax With Ajax Builder
 * Version: 1.0
 * Created by Pooya Sabramooz. <pooya_alen1990@yahoo.com> <https://github.com/pooya-alen1990>
 * User: p.sabramooz
 * Date: 5/16/2016
 * Time: 9:08 AM
 * Last modified: 5/17/2016
 * Copyright (C): 2016 All Rights Reserved
 *
 * GNU General Public License (Version 2, June 1991)
 *
 * This program is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 ******************************************************************/


class AjaxBuilder{

    private $type;
    private $url;
    private $eventSelector;
    private $script = false;
    private $ready = false;
    private $event = false;
    private $debug = false;
    private $data = "";
    private $output = "";
    private $debugString = "";
    private $beforeLoading = "";
    private $afterLoading = "";

    /**
     * AjaxBuilder constructor.
     * @param $type
     * @param $url
     */
    public function __construct($type, $url){
        $this->setType($type);
        $this->setUrl($url);
    }

    /**
     * @param mixed $type
     */
    private function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $url
     */
    private function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param $selector
     * @param $isMinify
     */
    public function go($selector, $isMinify){

        $this->header();
        $this->init();
        $this->data();
        $this->success($selector);
        $this->error();
        $this->footer();
        if($isMinify && !$this->debug){
            $this->output = str_replace(" ","",$this->output);
            $this->output = str_replace("\n","",$this->output);
            $this->output = str_replace("\r","",$this->output);
            $this->output = str_replace("\t","",$this->output);
            echo $this->output;
        }else{
            echo $this->output;
        }

    }

    private function header(){

        if($this->script){
            $this->output .= "
<script>";
        }

        if($this->ready){
            $this->output .= "
$(document).ready(function(){";
        }

        if($this->event){
            $this->output .= "
    $(\"$this->eventSelector\").$this->event(function(){";
        }

    }

    private function init(){
        if($this->debug) {
            $this->output .= $this->debugString;
        }

        $this->output .= $this->beforeLoading;

        $this->output .= "
        $.ajax({
            url : '$this->url',
            type: '$this->type',";
    }

    private function data(){
        $this->data = trim($this->data,",
        ");
        $this->output .= "
            data : {
                $this->data    
            },";
    }

    /**
     * @param $selector
     */
    private function success($selector){

        if($this->debug){

            $this->output .= "
            success:function(data, textStatus, jqXHR){
                console.log(\"Result : \" + data);
                $selector(data);
                $this->afterLoading
            }";

        }else{

            $this->output .= "
            success:function(data, textStatus, jqXHR){
                $selector(data);
            }";

        }

    }

    /**
     *  if you want to change error handling, this section is for you!!!
     */
    private function error(){
        $this->output .= ",
            error: function(jqXHR, textStatus, errorThrown){
                console.log('Error No. 04'+' - '+textStatus+' - '+errorThrown)
            }
        });";
    }

    private function footer(){

        if($this->event){
            $this->output .= "
    });";
        }

        if($this->ready){
            $this->output .= "
});";
        }

        if($this->script){
            $this->output .= "
</script>";
        }

    }

    /**
     *  Call this function if You want to cover your
     *  jQuery codes in HTML script tags (<script></script>).
     */
    public function hasScript(){
        $this->script = true;
    }

    /**
     *  Call this function if You want to run your
     *  jQuery codes, after page loaded completely.
     */
    public function hasReady(){
        $this->ready = true;
    }

    /**
     *  Call this function if You want to run your
     *  jQuery codes in debugger mode, in this mode
     *  minify action is not working.
     */
    public function debugMode(){
        $this->debug = true;
    }

    /**
     * @param $event_type
     * @param $selector
     */
    public function hasEvent($event_type, $selector){
        $this->event = $event_type;
        $this->eventSelector = $selector;
    }


    /**
     * @param $loadingSelector
     * @param $className
     */
    public function addLoading($loadingSelector, $className){

        $this->beforeLoading .= "
               $('$loadingSelector').addClass('$className');
        ";

        $this->afterLoading .= "
               $('$loadingSelector').removeClass('$className');
        ";


    }

    /**
     * @param $paramName
     */
    public function addParamWithName($paramName){

        $this->debugString .= "
        console.log(\"$paramName : \"+$('[name=$paramName]').val()+\" Added With Name Attr\");
        ";

        $this->data .= "$paramName : $('[name=$paramName]').val(),
                ";
    }

    /**
     * @param $paramId
     */
    public function addParamWithId($paramId){

        $this->debugString .= "
        console.log(\"$paramId : \" + $('#$paramId').val() + \"  Added With ID Attr\");
        ";

        $this->data .= "$paramId : $('#$paramId').val(),
                ";

    }

    /**
     * @param $paramClass
     */
    public function addParamWithClass($paramClass){

        $this->debugString .= "
        console.log(\"$paramClass : \" + $('.$paramClass').val() + \"  Added With Class Attr\");
        ";

        $this->data .= "$paramClass : $('.$paramClass').val(),
                ";

    }

    /**
     * @param $paramName
     * @param $paramValue
     */
    public function addParamWithNameAndValue($paramName, $paramValue){

        $this->debugString .= "
        console.log(\"$paramName : \" + $paramValue + \"  Added With Name/Value pair\");
        ";

        $this->data .= "$paramName : $paramValue,
                ";

    }

}