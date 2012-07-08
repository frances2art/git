<?php

/**
 * Homepage presenter.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class SearchPresenter extends SecuredPresenter
{

	
	public function createComponentSearchTasks()
	{
	    $tasks = $this->context->createTasks()->where("text LIKE ?", "%".$this->getParam('s_search')."%");
            if($this->getParam('s_tasklist')){
		$tasks->where('tasklist_id',$this->getParam('s_tasklist'));
	    }
	    if($this->getParam('s_user')){
		$tasks->where('user_id',$this->getParam('s_user'));
	    }
	   
	    $taskList = new TaskList($tasks, $this->context->createTasks());
	    $taskList->setDisplayTaskList(TRUE);
	    $taskList->setDisplayUser(TRUE);
	    return $taskList;
	}
	
	

}
