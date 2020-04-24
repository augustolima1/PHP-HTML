<?php

namespace source;


class Form
{
    
    private $title;
    
    private $elemsBox;
    
    private $elemsBtn;
    
    private $build;
    
    private $buildBtn;
    
    private $attrs = array();
    
    
    
    
    public function __construct($title = '', $attrs = array())
    {
        
        $this->title = $title;
        
        $this->attrs = $attrs;
    }
    
    
    private function Row()
    {
        
        $row = new html('div', array(
            'class' => 'form-row',
            'text' => $this->elemsBox
        ));
        
        $this->build .= $row;
    }
    
    
    
    
    private function box()
    {
        $box = new html('div', array(
            'class' => 'box box-primary'
        ));
        
        
        $boxHeader = new html('div', array(
            'class' => 'box-header with-border'
        ));
        
        $heading = new html('h3', array(
            'text' => $this->title,
            'class' => 'box-title'
        ));
        
        $boxHeader->prepend($heading);
        
        
        
        $boxBody = new html('div', array(
            'class' => 'box-body',
            'text' => $this->build
        ));
        
        
        $form = new html('form', array(
            'text' => $boxBody . $this->buildBtn
            
        ));
        
        $form->attr($this->attrs);
        
        
        
        
        $box->prepend($boxHeader, $form);
        
        return $box;
    }
    
    
    
    private function formGroup($input, $with = '', $label = '', $exec = 0)
    {
        
        $formGroup = new html('div', array(
            'class' => 'form-group col'
        ));
        
        $label = new html('label', array(
            'text' => $label
        ));
        
        
        
        $this->elemsBox .= $formGroup->append($label, $input);
        
        $this->attrs = array();
        
        if ($exec === 1) {
            $this->Row();
            $this->elemsBox = '';
        }
        
        
    }
    
    
    
    private function boxFooter()
    {
        $boxFooter = new html('div', array(
            'class' => 'box-footer',
            'text' => $this->elemsBtn
        ));
        
        
        $this->buildBtn .= $boxFooter;
    }
    
    
    
    
    
    private function formGroupBtn($input, $with = '', $label = '', $exec = 0)
    {
        $this->elemsBtn .= $input;
        
        $this->attrs = array();
        
        
        if ($exec === 1) {
            $this->boxFooter();
        }
    }
    
    
    
    
    
    public function attr($attrs, $value = null)
    {
        $this->attrs = is_array($attrs) ? $attrs : array(
            $attrs => $value
        );
        
        return $this;
    }
    
    
    
    
    
    public function TText($with = '', $label = '', $name = '', $exec = 0)
    {
        
        $input = new html('input', array(
            'name' => $name,
            'class' => 'form-control'
        ));
        
        $input->attr($this->attrs);
        
        $this->formGroup($input, $with, $label, $exec);
        
        
        
        
        return $this;
    }
    
    
    
    
    public function TSubmit($width = '', $label = '', $exec = 0)
    {
        
        $input = new html('input', array(
            'type' => 'submit',
            'class' => 'btn btn-primary',
            'value' => $label
        ));
        
        $input->attr($this->attrs);
        
        
        $this->formGroupBtn($input, $width, $label, $exec);
        
        return $this;
    }
    
    
    
    
    public function exec()
    {
        echo $this->box();
    }
    

    
    
    
    
}

?>