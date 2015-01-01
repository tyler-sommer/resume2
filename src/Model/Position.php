<?php

namespace TylerSommer\Resume\Model;

class Position
{
    public $company;

    public $title;

    public $location;

    public $from;

    public $to;

    /**
     * @var array|string[]
     */
    public $description = array();
}
