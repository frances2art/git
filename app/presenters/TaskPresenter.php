<?php
use Nette\Application\UI\Form,
    Nette\Forms,
    Navigation\Navigation;

class TaskPresenter extends SecuredPresenter
{
private $task;
private $taskList;
private $paginator;
private $id;

public function actionDefault($id)
    {
    $this->taskList = $this->context->createTasklists()->get($id);
    $this->id=$id;
     if ($this->taskList === FALSE) {
        $this->setView('notFound');
    }
    }

  

public function renderDefault($id)
    {
    $this->template->taskList = $this->taskList;
    $this->template->paginator=$this->paginator;
    }
    
    
  public function renderDetail($id)
    {
    $this->template->task = $this->task;
    }
    
    
public function actionDetail($id,$task_id)
    {
    $this->task = $this->context->createTasks()->get($task_id);

    $this->taskList=$this->context->createTaskLists()->get($id);
     if ($this->taskList === FALSE) {
        $this->setView('notFound');
    }
    }  
   
    

public function createComponentComment(){
     $this->id=1;//zatim nastaveno pevne je potreba promyslet databazovou strukturu
     $comments=new Comments($this->context->createComment()->where(array('id_cms' => $this->id)), $this->context->createComment(),$this->id);
     $comments->setDisplayMail(TRUE);
     $comments->setAjax($this->isAjax());
     return $comments;
     
}
    


protected function createComponentTaskList()
{
    //$tasks = $this->taskList->related('task');
    return new TaskList($this->context->createTasks()->where(array('tasklist_id' => $this->id)), $this->context->createTasks());
}


protected function createComponentTaskForm()
    {
      if (!$this->getUser()->isLoggedIn()) {
        throw new Nette\Application\ForbiddenRequestException();
      }
      
      
    $form = new Form();
    $form->addText('text', 'Úkol:', 40, 100)->addRule(Form::FILLED, 'Je nutné zadat text úkolu.');
    $form->addSelect('done','Hotovo: ', array('1' => 'cajk','0' => 'blbý'))
    ->setPrompt('- Vybrat -')->addRule(Form::FILLED, 'Vyber jestli je splnen.');
    $form->addSelect('userId', 'Pro:', $this->context->createUsers()->fetchPairs('id', 'name'))
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné vybrat, komu je úkol přiřazen.')
        ->setDefaultValue($this->getUser()->getId());
    $form->addSubmit('create', 'Vytvořit');
    
    $form->onSuccess[] = callback($this, 'taskFormSubmitted');
    
    return $form;
    }
    
    public function handleDeleteTaskList()
    {
    $this->taskList->related('task')->delete();
    $this->taskList->delete();
    $this->presenter->redirect('Homepage:');
    }
    
    public function taskFormSubmitted(Form $form)
    {
    
    $this->context->createTasks()->insert(array(
        'text' => $form->values->text,
        'user_id' => $form->values->userId,
        'created' => new DateTime(),
        'tasklist_id' => $this->taskList->id,
        'done' => $form->values->done
    ));
    $this->flashMessage('Úkol přidán.', 'success');
    if (!$this->isAjax()) {
        $this->redirect('this');
    } else {
        //$form->setValues(array(), TRUE);
        $this->invalidateControl('form');
        $this['taskList']->invalidateControl();
        $form->setValues(array('userId' => $form->values->userId), TRUE);
    }
    }
    

    protected function createComponentNavigation($name) {
    $nav = new Navigation($this, $name);
    $nav->setupHomepage("Úvod", $this->link("Homepage:"));
    if($this->taskList->id){
    $sec = $nav->add($this->taskList->title, $this->link("Task:", $this->taskList->id));
    $nav->setCurrentNode($sec);
    }
    if($this->task){
    $detail = $sec->add($this->task->text, $this->link("Task:detail", $this->task));
    $nav->setCurrentNode($detail);
    }
    
    }

}

?>