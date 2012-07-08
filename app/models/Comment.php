<?php

use Nette\Database\Connection,
    Nette\Database\Table\Selection;


class Comment extends Selection
{
    public function __construct(Connection $connection)
    {
        parent::__construct('comment', $connection);
    }
}