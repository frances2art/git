<?php
use Nette\Application\UI\Form,
    Nette\Forms;
   
class ContactForm extends Form{
    public function __construct(Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
        parent::__construct($parent, $name);
        return $this->buildForm();
    }
    
    public function buildForm(){
        
   $this->addText('name','Vase jmeno')->addRule(Form::FILLED,'Vyplnte jmeno');
   $this->addText('mail', 'Vas mail')->addRule(Form::FILLED,'Vyplnte email')->addRule(Form::EMAIL,'Neni platny mail');
   $this->addTextArea('text', 'Text', 40, 10)->addRule(Form::FILLED,'Vyplnte text');
   $this->addSubmit('ok','odeslat');
    
    }

}
?>
