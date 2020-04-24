<?php
  require_once 'source/Html.class.php';
  require_once 'source/Form.class.php';


  use source\html;
  use source\form;

  
  $Form = new Form("Title",array("name"=>"cadastro"));


  $Form->TText(1,'Nome',    'nome',0);
  
  $Form->TText(1,'Email',   'email',1);

  $Form->attr("type","password")
       ->TText(1,'Password','password',1);


  $Form->attr("class","btn btn-default")
       ->TSubmit(1,"Cancelar",0);
  
  $Form->TSubmit(1,"Salvar",1);

 
  $Form->exec();
 ?>

 