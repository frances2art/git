<?php

use Nette\Application\UI,
    Nette\Utils\Paginator,
    Nette\Database\Table\Selection;

class TaskList extends UI\Control
{
    /** @var \Nette\Database\Table\Selection */
    private $tasks;
    private $table;
    private $count;
    private $vp;
    private $paginator;
    private $displayUser = TRUE;
    private $displayTaskList = FALSE;
    
    public function __construct(Selection $tasks, Tasks $table)
    {
        parent::__construct(); // vždy je potřeba volat rodičovský konstruktor
        
        
        $vp = new VisualPaginator($this, 'paginator');
        $paginator = $vp->getPaginator();
        $paginator->itemsPerPage = 4;
        $paginator->itemCount = $tasks->count('*');
 
        $this->tasks = $tasks;
        $this->table = $table;
        $this->vp=$vp;
    }
    
    public function handleLink($taskId)
    {
 
        $this->presenter->redirect($this->link('Task:detail',$taskId));
    
    }
    
    
    public function handleMarkDone($taskId)
    {
    $this->table->where(array('id' => $taskId))->update(array('done' => 1));
     if (!$this->presenter->isAjax()) {
        $this->presenter->redirect('this');
    } else {
        $this->invalidateControl();
    }
    }

     public function handleMarkUnDone($taskId)
    {
    $this->table->where(array('id' => $taskId))->update(array('done' => 0));
     if (!$this->presenter->isAjax()) {
        $this->presenter->redirect('this');
    } else {
        $this->invalidateControl();
    }
    }

    public function setDisplayTaskList($displayTaskList)
    {
    $this->displayTaskList = $displayTaskList;
    }

    public function setDisplayUser($displayUser)
    {
        $this->displayUser = $displayUser;
    }
    
    public function render()
    {
        $this->template->setFile(__DIR__ . '/TaskList.latte');
        $this->template->tasks = $this->tasks->limit($this->vp->paginator->itemsPerPage, $this->vp->paginator->offset);
        $this->template->displayUser = $this->displayUser;
        $this->template->displayTaskList = $this->displayTaskList;
        $this->template->render();
    }
}

?>