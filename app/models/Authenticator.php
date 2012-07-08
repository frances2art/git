<?php

use Nette\Security as NS;


/**
 * Users authenticator.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class Authenticator extends Nette\Object implements NS\IAuthenticator
{
	/** @var Nette\Database\Table\Selection */
	private $users;


	public function __construct(Nette\Database\Table\Selection $users)
	{
		$this->users = $users;
	}



	/**
	 * Performs an authentication
	 * @param  array
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->users->where('username', $username)->fetch();
		if (!$row) {
			throw new NS\AuthenticationException("User '$username' not found.", self::IDENTITY_NOT_FOUND);
		}

		if ($row->password !== $this->calculateHash($password)) {
			throw new NS\AuthenticationException("Invalid password.", self::INVALID_CREDENTIAL);
		}

		unset($row->password);
		//return new NS\Identity($row->id, $row->role, $row->toArray
		return new NS\Identity($row->id, $row->role, $row->toArray());
	}

        
        public function register($values,$kontrolni_link){
            
                
 
                
                if($this->checkUsername($values->username) and $this->checkMail($values->mail)){
                 return $this->users->insert(array(
                 'mail' => $values->mail,
                 'username' => $values->username,
                 'name' => $values->name,
                 'password' => $values->password,
                 'created' => new DateTime(),
                 'role' => 'user',
                 'active' => $kontrolni_link
                 ));
                }
            
        }
        
        public function checkUsername($username)
        {
            $row = $this->users->where('username', $username)->fetch();
            if($row){
                return false;
            }
            else{
                return true;
            }
        }
        
        public function checkMail($mail)
        {
            $row = $this->users->where('mail', $mail)->fetch();
            if($row){
                return false;
            }
            else{
                return true;
            }
        }

         public function control($control)
        {
            $row = $this->users->where('active', $control)->fetch();
            if($row){
                $this->users->where(array('active' => $control))
                ->update(array('active' => 0));
                
            }
            else{
               throw new NS\AuthenticationException("Špatný kontrolní kód.", self::INVALID_CREDENTIAL);
            }
        }
        
         public function checkControl($username)
        {
            $row = $this->users->where('username', $username)->fetch();
	    //var_dump($row);
            if($row){
               throw new NS\AuthenticationException("Uzivatel nebyl overen.", self::IDENTITY_NOT_FOUND);
            }
            
      
        }
        
	public function setPassword($id, $password)
	{
	    $this->users->where(array('id' => $id))
		->update(array('password' => $this->calculateHash($password)));
	}
	
	public function calculateHash($password)
	{	
	    return hash('sha512', $password);
	}
}
