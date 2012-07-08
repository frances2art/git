<?php

use Nette\Database\Connection,
    Nette\Database\Table\Selection;


class Cms extends Selection
{

  
    public function __construct(Connection $connection)
    {
        parent::__construct('cms', $connection);
    }
    
  
    public function insertCms($values){
	$this->context->createCms()->where('id', $values->id)->update(array(
        'nadpis' => $values->nadpis,
        'text' => $values->text
	));
    }
    public function updateCms($values){
	
	return $this->context->createCms()->where('nadpis != ?', $values->nadpis)->insert(array(
        'nadpis' => $values->nadpis,
        'text' => $values->text
	));
    }
}