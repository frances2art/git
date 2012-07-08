<?php

use Nette\Application\UI,
    Nette\Database\Table\Selection,
    Nette\Forms,
    Nette\Application\UI\Form;

class Comments extends UI\Control
{
    private $comments;
    private $table;
    private $id;
    private $displayMail = TRUE;
    private $ajax = FALSE;
  
    
    public function __construct(Selection $comments, Comment $table, $id)
    {
        parent::__construct(); 
        
        $this->comments = $comments;
        $this->table = $table;
        $this->id = $id;
    }

    
    protected function createComponentCommentForm()
    {
    $form = new Form();
    $form->addText('text', 'Text:', 40, 100)->addRule(Form::FILLED, 'Je nutné zadat text komentáře.');
    $form->addText('mail', 'Email:', 5, 30)->addRule(Form::FILLED, 'Je nutné zadat email.')->addRule(Form::EMAIL, 'E-mail není validní');
    $form->addSubmit('create', 'Vytvořit');

    $form->onSuccess[] = callback($this, 'commentFormSubmitted');
    
    return $form;
    }
    
    
    public function setDisplayMail($displayMail)
    {
    $this->displayMail = $displayMail;
    }
    
    public function setAjax($ajax)
    {
    $this->ajax = $ajax;
    }

    
    public function commentFormSubmitted(Form $form)
    {
        
    
    
    $this->table->insert(array(
        'mail' => $form->values->mail,
        'text' => $form->values->text,
       // 'created' => new DateTime(),
        'id_cms' => $this->id
    ));
    $this->flashMessage('Komentář přidán.', 'success');
   if (!$this->ajax) {
        $this->redirect('this');
    } else {
        $this->invalidateControl('form');
        $this['cms']->invalidateControl();
        $form->setValues(array('mail' => $form->values->mail), TRUE);
    }
    }
    
    
    public function render()
    {
        $this->template->setFile(__DIR__ . '/Comments.latte');
        $this->template->comments = $this->comments;
        $this->template->displayMail = $this->displayMail;
        $this->template->render();
    }
}

?>