<?php

use Nette\Database\Connection,
    Nette\Database\Table\Selection;


class Tasklists extends Selection
{
    public function __construct(Connection $connection)
    {
        parent::__construct('tasklist', $connection);
    }
}