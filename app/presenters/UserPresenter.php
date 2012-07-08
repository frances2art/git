<?php
use Nette\Application\UI\Form;
use Nette\Security as NS;


class UserPresenter extends SecuredPresenter
{
    protected function createComponentPasswordForm()
    {
        $form = new Form();
        $form->addPassword('oldPassword', 'Staré heslo:', 30)
            ->addRule(Form::FILLED, 'Je nutné zadat staré heslo.');
        $form->addPassword('newPassword', 'Nové heslo:', 30)
            ->addRule(Form::MIN_LENGTH, 'Nové heslo musí mít alespoň %d znaků.', 6);
        $form->addPassword('confirmPassword', 'Potvrzení hesla:', 30)
            ->addRule(Form::FILLED, 'Nové heslo je nutné zadat ještě jednou pro potvrzení.')
            ->addRule(Form::EQUAL, 'Zadná hesla se musejí shodovat.', $form['newPassword']);
        $form->addSubmit('set', 'Změnit heslo');
        $form->onSuccess[] = callback($this, 'passwordFormSubmitted');
        return $form;
    }


    public function passwordFormSubmitted(Form $form)
    {
        $values = $form->getValues();
        $user = $this->getUser();
        try {
            $this->context->authenticator->authenticate(array($user->getIdentity()->username, $values->oldPassword));
            $this->context->authenticator->setPassword($user->getId(), $values->newPassword);
            $this->flashMessage('Heslo bylo změněno.', 'success');
            $this->redirect('Homepage:');
        } catch (NS\AuthenticationException $e) {
            $form->addError('Zadané heslo není správné.');
        }
    }
}
?>