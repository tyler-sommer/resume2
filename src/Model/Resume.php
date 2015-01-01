<?php

namespace TylerSommer\Resume\Model;

class Resume
{
    public $name;

    public $phone;

    public $email;

    public $title;

    /**
     * @var array|string[]
     */
    public $description = array();

    /**
     * @var array|string[]
     */
    public $profile = array();

    /**
     * @var array|Position[]
     */
    public $experience = array();

    /**
     * @var array|string[]
     */
    public $extra = array();

    /**
     * @var array|Qualification
     */
    public $qualifications = array();
}
