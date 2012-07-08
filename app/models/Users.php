<?php

use Nette\Database\Connection,
    Nette\Database\Table\Selection;


class Users extends Selection
{
    
    private $users;
        
    public function __construct(Connection $connection)
    {
        parent::__construct('user', $connection);
        
    }

}