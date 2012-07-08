<?php

use Nette\Application\UI,
	Nette\Security as NS,
	Nette\Application\UI\Form,
        External\AntispamControl,
        Nette\Mail\Message;


/**
 * Sign in/out presenters.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class RegistrationPresenter extends BasePresenter
{
	public function ActionCheck($control)
	{
            try{
            $this->context->authenticator->control($control);
            $this->flashMessage('Váě účet byl ověřen.', 'success');    
            $this->redirect('Homepage:');
            } catch (NS\AuthenticationException $e) {
                $this->flashMessage('Váš účet nebyl ověřen.', 'error');  
                $this->redirect('Homepage:');
                
	    }
            
           
        }
	
	protected function createComponentRegistrationForm()
	{
		$form = new Form();
                $form->addAntispam();
                $form->addText('name', 'Celé jméno:', 30, 30);
                $form->addText('mail', 'E-mail:', 30, 30)->setRequired('Mail je povinný')->addRule(Form::EMAIL, 'Neplatná emailová adresa');;
		$form->addText('username', 'Uživatelské jméno:', 30, 10)->setRequired('Uživatelské jméno je povinné');
		$form->addPassword('password', 'Heslo:', 30)->setRequired('Zvolte si heslo')->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 5);
                $form->addPassword('password2', 'Heslo znovu:', 30)->setRequired('Zvolte si heslo znovu')->addRule(Form::EQUAL, 'Hesla se neshodují', $form['password']);
		$form->addSubmit('registration', 'Registration');
		$form->onSuccess[] = callback($this, 'registrationFormSubmitted');
                
		return $form;
	}



	public function registrationFormSubmitted(Form $form)
	{
	    
		$user = $this->context->createUsers();
		$values = $form->getValues();
                
               
                 try {
                $control_link = sha1($values->username. time() . 'e743dd075ff52c2');
                $row=$this->context->authenticator->register($values,$control_link);
		$auth =new Authenticator($user);
                $auth->setPassword($row->id, $form->values->password);
                
                
                
                $mail = new Message();
		$mail->setFrom('Registrace na webu xxx.com <info@xxx.com>');
		$mail->addTo($values->mail);
		$mail->setSubject('Registrace na webu xxx.com');
		$mail->setBody("Děkujeme za Váši registraci. Potvrďte prosím na adrese" . $this->link('//Registrace:kontrola', array('kontrola'=>$control_link)) . ".");
		$mail->send();
                
                $this->flashMessage('Uživatel '.$row->id.' přidán. Na váš mail byl zaslán potvrzující kód', 'success');
		$this->redirect('Homepage:');
	    } catch (NS\AuthenticationException $e) {

                $this->flashMessage('Uživatel nebyl vytvořen.', 'error');    
                
	    }
            
            
                
                
                
                
                
                
                
                
    
		//$this->redirect('Homepage:');
	    
	}



	

}
