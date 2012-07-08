<?php
use Nette\Application\UI\Form,
    Nette\Forms,
    Nette\Utils\Strings,
    Nette\Image,
    Nette\Mail\Message;
    
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

   /** @persistent */
   public $s_tasklist;
   /** @persistent */
   public $s_search;
   /** @persistent */
   public $s_user;
     protected function startup()
    {
        parent::startup();
        AntispamControl::register();
        AntispamControl::$minDelay = 2;  // 15 sec
        //$this->s_search=$this->s_user=$this->s_tasklist=null;
       /* $mailer = new Nette\Mail\SmtpMailer(array(
        'host' => 'smtp.gmail.com',
        'username' => 'frances2art@gmail.com',
        'password' => 'Frances007',
        'transport' => 'ssl',
        'port' => 465,
        'timeout' => 30
        ));
        
        $mail = new Message;
        $mail->setFrom('Franta <franta@example.com>')->addTo('petr@example.com')
             ->addTo('frances2art@gmail.com')->setSubject('Potvrzení objednávky')
             ->setBody("Dobrý den,\nvaše objednávka byla přijata.")
             ->setMailer($mailer)->send();
        * 
        * $image = Image::fromFile("http://nd04.jxs.cz/204/347/a423bcfa7d_73350992_o2.jpg");
    $image->resize(250, 300, Image::EXACT);
    $image->sharpen();
    $image->save('resampled.jpg', 80, Image::JPEG);
        * 
        */

    }
    
   

        
    public function beforeRender()
    {
    
    
    $this->template->taskLists = $this->context->createTasklists()->order('title ASC');
    $this->template->cms =  $this->context->createCms()->order('nadpis ASC');

        if ($this->isAjax()) {
        $this->invalidateControl('flashMessages');
        }
    }
    
    
    
    protected function createComponentNewTasklistForm()
    {
        if (!$this->getUser()->isLoggedIn()) {
        throw new Nette\Application\ForbiddenRequestException();
         }
    
        $form = new Form();
        $form->addText('title', 'Název:', 15, 50)
            ->addRule(Form::FILLED, 'Musíte zadat název seznamu úkolů.');
        $form->addSubmit('create', 'Vytvořit');
        $form->onSuccess[] = callback($this, 'newTasklistFormSubmitted');
        return $form;
    }
    
    public function newTasklistFormSubmitted(Form $form)
    {
        $tasklist = $this->context->createTasklists()->insert(array(
            'title' => $form->values->title
        ));
        
          
        $this->context->createTaskLists()->where('id', $tasklist->id)->update(array(
        'uri' => $tasklist->id."-".Strings::webalize($form->values->title)
        ));
    

                
        $this->flashMessage('Seznam úkolů založen.', 'success');
        $this->redirect('Task:default', $tasklist->id);
    }
    
    public function handleSignOut()
    {
        $this->getUser()->logout();
        $fbCookieName = 'fbsr_' . $this->context->facebook->getAppId();
        if ($this->context->httpRequest->getCookie($fbCookieName) !== NULL) {
            $this->context->httpResponse->deleteCookie($fbCookieName);
        }
        $this->context->facebook->destroySession();
        $this->redirect('Sign:in');
    }
    
    
    protected function createComponentSearchForm()
        {
        $form = new Form();
        $form->addText('text', 'Vyhledat:', 20, 30)->addRule(Form::FILLED, 'Je nutné zadat text.')
         ->setDefaultValue($this->s_search);
         $form->addSelect('user', 'Pro:', $this->context->createUsers()->fetchPairs('id', 'name'))
        ->setPrompt('- Vyberte -')
        ->setDefaultValue($this->s_user);
         
          $form->addCheckboxList('tasklist', 'Pro:', $this->context->createTaskLists()->fetchPairs('id', 'title'))
        ->setDefaultValue($this->s_tasklist);          
          
          
        
        $form->addSubmit('search', 'Vyhledat');

        $form->onSuccess[] = callback($this, 'searchFormSubmitted');

        return $form;
        }
    
    
        public function searchFormSubmitted(Form $form)
      {
            
            
         $this->s_search=$form->values['text'];
         $this->s_tasklist=$form->values['tasklist'];
         $this->s_user=$form->values['user'];
                    
                    
        $this->redirect('Search:default');
        $this->terminate();
       }

       
       
}
