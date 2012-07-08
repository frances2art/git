<?php

use Nette\Application\UI\Form,
    Nette\Mail\Message;
/**
 * Homepage presenter.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class HomepagePresenter extends SecuredPresenter
{


	public function createComponentIncompleteTasks()
	{	
	$tasks = $this->context->createTasks()->order('done,created ASC');
	return new TaskList($tasks, $this->context->createTasks());
	}
	
	public function createComponentUserTasks()
	{
	    $tasks = $this->context->createTasks()->where(array(
		'done' => false, 'user_id' => $this->getUser()->getId()
	    ));
	    $taskList = new TaskList($tasks, $this->context->createTasks());
	    $taskList->setDisplayTaskList(TRUE);
	    $taskList->setDisplayUser(FALSE);
	    return $taskList;
	}
        
        public function createComponentContactForm($name){
            $form=new ContactForm($this,$name);
            $form->onSuccess[] = callback($this, 'contactFormSubmitted');
            return $form;
        }
        public function contactFormSubmitted(Form $form){
            $mail = new Message;
            
            $mail->setFrom($form->values->mail);
	    $mailConfig = \Nette\Environment::getConfig('mail');
            $mail->addTo($mailConfig->to);
            //$mail->setSubject();
            $template=$this->createTemplate();
            $template->setFile(APP_DIR.'/templates/emails/contact.latte');
            $template->title='Pokus z kontaktniho formulare';
            $template->form=$form;
            $mail->setHtmlBody($template);
            $mail->send();
            $this->flashMessage("Zprava odeslana","success");
            $this->redirect('this');
            
        }
        
            
        
	
	

}
