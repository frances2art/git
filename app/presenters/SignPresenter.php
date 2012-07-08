<?php

use Nette\Application\UI,
	Nette\Security as NS,
	Nette\Application\UI\Form,
        External\AntispamControl;


/**
 * Sign in/out presenters.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class SignPresenter extends BasePresenter
{

	
	public function ActionIn()
	{
	        $uid = $this->context->facebook->getUser();
                $this->template->uid=$uid; 
                if ($uid) {
                $this->template->facebookLogoutUrl = $this->context->facebook->getLogoutUrl(array('next'=>$this->link('//signOut!')));
                
                
                
                $facebookuser=$this->context->facebook->api('/'.$uid);
                
                
                $user = $this->context->createUsers();
                
                
                $row1=$user->where('username', $facebookuser['username'])->fetch();
                
                $row2=$this->context->createUsers()->where('mail', $facebookuser['email'])->fetch();
                
                $kontrolni_link = sha1($facebookuser['username'] . time() . 'e743dd075ff52c2');
 
                
                    if(!$row1 and !$row2){
                    $row = $user->insert(array(
                    'mail' => $facebookuser['email'],
                    'username' => $facebookuser['username'],
                    'name' => $facebookuser['name'],
                    'password' => $facebookuser['id'],
                    'created' => new DateTime(),
                    'role' => 'fb_user',
                    'active' => $kontrolni_link
                    ));

                    $auth =new Authenticator($user);
                    $auth->setPassword($row->id, sha1($facebookuser['id']));

                    

                    
                    }
                    
                    $user = $this->getUser();
                    $user->setExpiration('+30 days', FALSE);

                    $user->login($facebookuser['username'],sha1($facebookuser['id']));
                    
                    $this->flashMessage('Přihlášení bylo úspěšné.', 'success');
                    $this->redirect('Homepage:');
                    
                    
                    
                }
                else{
                $this->template->facebookLoginUrl = $this->context->facebook->getLoginUrl(array('scope'=>'email'));      
                }
                
               
                
               
		
	    
	}
	/**
	 * Sign in form component factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Form();
                $form->addAntispam();
		$form->addText('username', 'Uživatelské jméno:', 30, 20);
		$form->addPassword('password', 'Heslo:', 30);
		$form->addCheckbox('persistent', 'Pamatovat si mě na tomto počítači');
		$form->addSubmit('login', 'Přihlásit se');
		$form->onSuccess[] = callback($this, 'signInFormSubmitted');
                
		return $form;
	}



	public function signInFormSubmitted(Form $form)
	{
	    try {
		$user = $this->getUser();
		$values = $form->getValues();
		if ($values->persistent) {
		    $user->setExpiration('+30 days', FALSE);
		}
                $user->login($values->username,$values->password);
		//$this->context->authenticator->checkControl($values->username);
		$row = $this->context->createUsers()->where('username', $values->username)->fetch();
		if($row->active){
		    throw new NS\AuthenticationException("Uzivatel nebyl overen.");
		}
               
		$this->flashMessage('Přihlášení bylo úspěšné.', 'success');
		$this->redirect('Homepage:');
	    } catch (NS\AuthenticationException $e) {
                
		$form->addError($e->getMessage(),'error');
	    }
	}



	public function actionOut()
	{
		$this->getUser()->logout();
                
                
		$this->flashMessage('You have been signed out.');
		//$this->redirect('in');
	}

}
