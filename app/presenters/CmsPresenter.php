<?php
use Nette\Application\UI\Form,
    Nette\Forms,
    Nette\Caching\Cache;

class CmsPresenter extends SecuredPresenter
{
private $id;
private $cm;
private $comments;

protected function startup()
    {
        parent::startup();  
        /*if (!$this->getUser()->isLoggedIn()) {
        $this->flashMessage("kokot", "error");
        $this->redirect('Homepage:');
              
       }*/
        
    }
    
public function actionDefault($id)
    {
    $this->cm = $this->context->createCms()->get($id);
     if ($this->cm === FALSE) {
        $this->setView('notFound');
    }
    }

public function renderDefault($id)
    {   
    $this->template->comments = $this->cm->related('comment')->order('id DESC');
    $this->template->cm = $this->cm;
    
    }
    
public function createComponentComment(){

     $comments=new Comments($this->context->createComment()->where(array('id_cms' => $this->cm->id)), $this->context->createComment(),$this->cm->id);
     $comments->setDisplayMail(FALSE);
     $comments->setAjax($this->isAjax());
     return $comments;
     
}
    
    protected function createComponentTestForm()
    {
    
    Nette\Forms\Form::extensionMethod('addDateTimePicker', function(Nette\Forms\Form $container, $name, $label){
        return $container[$name] = new External\DateTimePicker($label);
    });
    
    
     Nette\Forms\Form::extensionMethod('addDatePicker', function(Nette\Forms\Form $container, $name, $label){
        return $container[$name] = new External\DatePicker($label);
    });
    

    $form = new Form();
   
    $form->addDateTimePicker('date', 'Datetimepicker')->addCondition(Form::FILLED)->addRule(Form::RANGE, 'Vstup neni validni', array(new DateTime('-1 week 09:00'), new DateTime('+1 day 19:00')));
    $form->addDatePicker('datePicker1','Datepicker');
    $form->addText('text', 'Text:', 40, 100)->addRule(Form::FILLED, 'Je nutné zadat text komentáře.');
    $form->addText('email', 'Email:', 50, 30)->setType('email')->setDefaultValue('user@example.com')->addRule(Form::FILLED, 'Je nutné zadat email.')->addRule(Form::EMAIL, 'E-mail není validní');
    $form->addText('age', 'Věk:')->setType('number');
    $form->addCheckbox('agree', 'Souhlasím s podmínkami')->addRule(Form::EQUAL, 'Je potřeba souhlasit s podmínkami', TRUE);
    $countries = array(
    'Europe' => array(
        'CZ' => 'Česká Republika',
        'SK' => 'Slovensko',
        'GB' => 'Velká Británie',
    ),
    'CA' => 'Kanada',
    'US' => 'USA',
    '?'  => 'jiná',
    );
    $form->addSelect('country', 'Země:', $countries)->setPrompt('Zvolte zemi');
    $form['country']->setDefaultValue('SK');
    $form->addUpload('avatar', 'Avatar:')->addRule(Form::IMAGE, 'Avatar musí být JPEG, PNG nebo GIF.')->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 64 kB.', 64 * 1024 /* v bytech */);
    
    $form->addSubmit('create', 'Vytvořit');

    $form->onSuccess[] = callback($this, 'commentFormSubmitted');
    
    return $form;
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
    
    public function commentFormSubmitted(Form $form)
    {
        
       if (!$this->getUser()->isLoggedIn()) {
        throw new Nette\Application\ForbiddenRequestException();
       }
    
    $this->context->createComment()->insert(array(
        'mail' => $form->values->mail,
        'text' => $form->values->text,
       // 'created' => new DateTime(),
        'id_cms' => $this->cm->id
    ));
    $this->flashMessage('Komentář přidán.', 'success');
    if (!$this->isAjax()) {
        $this->redirect('this');
    } else {
        //$form->setValues(array(), TRUE);
        $this->invalidateControl('form');
        $this['cms']->invalidateControl();
        $form->setValues(array('mail' => $form->values->mail), TRUE);
    }
    }
    

   //admin
   public function actionAdmin($id)
       {
       $this->cm = $this->context->createCms()->get($id);
      
        //if ($this->cm === FALSE) {
        //   $this->setView('notFound');
        // }
       }
      
   public function renderAdmin($id)
       {
       $this->template->cm = $this->cm;
       if($id){
       $this->id=$id;
       $form = $this['cmsForm'];
       $form['nadpis']->setDefaultValue($this->cm->nadpis);
       $form['text']->setDefaultValue($this->cm->text);
       $form['id']->setDefaultValue($this->cm->id);
       }
       
       }
    
    
   protected function createComponentCmsForm($id)
    {
    $form = new Form();
    $form->addContainer('cms');
    $form->addTextArea('text', 'Text:', 40, 5)->addRule(Form::FILLED, 'Je nutné zadat text.')->getControlPrototype()->class('mceEditor');;
    $form->addText('nadpis', 'Nadpis:', 5, 50)->addRule(Form::FILLED, 'Je nutné zadat nadpis.');
    if($this->id){
	$form->addSubmit('create', 'Upravit');
    }
    else{
	$form->addSubmit('create', 'Vytvorit');
    }
    $form->addHidden('id',null);
    //ochrana CSRF
    $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
    //$form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
    $form->onSuccess[] = callback($this, 'cmsFormSubmitted');
    return $form;
    }
    
    public function handleDeleteCms($cmsId)
    {
    $this->context->createComment()->where('id_cms', $cmsId)->delete();
    $this->context->createCms()->where('id', $cmsId)->delete();
    $this->redirect('Cms:admin');
    }
    
    protected function createComponentFbToolsScript()
    {
        return $this->context->createFbToolsScript();
    }

    
   protected function createComponentLikeButton()
    {
        $fb = $this->context->createFbToolsLikeButton();
        //$fb->setUrl($this->link('//Cms:', $this->cm->id));
        $fb->setUrl("http://www.seznam.cz");
        return $fb;
    }

   protected function createComponentComments()
    {   
        $fb = $this->context->createFbToolsComments();
        $fb->setUrl('http://www.seznam.cz');
        $fb->setWidth(500);
        return $fb;
    }


   public function cmsFormSubmitted(Form $form)
    {
        
        if (!$this->getUser()->isLoggedIn()) {
        throw new Nette\Application\ForbiddenRequestException();
    }
    
    //MyApplication\Models\Register::create($values)
    
    if($form->values->id){
    $this->context->createCms()->where('id', $this->cm->id)->update(array(
        'nadpis' => $form->values->nadpis,
        'text' => $form->values->text
    ));
    $this->flashMessage('Text upraven', 'success');

    $this->redirect('Cms:default',$this->cm->id);
    }
    else{
	
    $row=$this->context->createCms()->where('nadpis != ?', $form->values->nadpis)->insert(array(
        'nadpis' => $form->values->nadpis,
        'text' => $form->values->text
    ));
    
    $this->flashMessage('Text vytvoren', 'success');

    $this->redirect('Cms:default',$row->id);
    }
	
    
   
    }

}

?>