<?php

namespace source;

class Html
{
    
    private $tag;
    private $attrs = array();
    private $closeTagList = array('input', 'img', 'hr', 'br');
    
    
    public function __construct($tag, $attrs = array())
    {
        $this->tag = $tag;
        
        
        
        $attrs['text'] = (empty($attrs['text'])) ? '' : $attrs['text'];
        
        
        $this->attrs = $attrs;
        
        return $this;
    }
    
    
    
    
    public function __toString()
    {
        return $this->build();
    }
    
    
    
    private function getAttr()
    {
        
        $attr = '';
        
        foreach ($this->attrs as $key => $value) {
            
            if ($key == 'text')
                continue;
            
            $attr .= ' ' . $key . '="' . $value . '"';
        }
        
        
        
        return $attr;
    }
    
    
    
    
    public function attr($attr, $value = null)
    {
        
        $this->attrs = is_array($attr) ? array_merge($this->attrs, $attr) : array_merge($this->attrs, array(
            $attr => $value
        ));
        
        
        return $this;
    }
    
    
    
    
    private function build()
    {
        
        $output = "<" . $this->tag . ' ' . $this->getAttr();
        
        $output .= in_array($this->tag, $this->closeTagList) ? "/>\n" : ">" . $this->attrs['text'] . "</" . $this->tag . ">\n";
        
        
        return $output;
    }
    
    
    
    
    
    
    private function check_class($obj)
    {
        return (get_class($obj) == __class__);
    }
    
    
    public function append()
    {
        
        $elems = func_get_args();
        
        foreach ($elems as $obj) {
            if (!$this->check_class($obj))
                continue;
            
            $this->attrs['text'] .= $obj->build();
        }
        
        return $this;
    }
    
    
    
    public function prepend()
    {
        $elems = func_get_args();
        
        $elems = array_reverse($elems);
        
        foreach ($elems as $obj) {
            if (!$this->check_class($obj))
                continue;
            
            $this->attrs['text'] = $obj->build() . $this->attrs['text'];
        }
        
        return $this;
    }
    
    
    
    public function appendTo($obj)
    {
        if (!$this->check_class($obj))
            return false;
        
        $obj->attrs['text'] .= $this->build();
    }
    
    
    
    public function prependTo($obj)
    {
        if (!$this->check_class($obj))
            return false;
        
        $obj->attrs['text'] = $this->build() . $obj->attrs['text'];
    }
    
    
    
    
}