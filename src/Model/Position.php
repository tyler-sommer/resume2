<?php

namespace TylerSommer\Resume\Model;

/**
 * A Position represents experience in a professional setting.
 */
class Position
{
    /**
     * @var string Employer name.
     */
    public $company;

    /**
     * @var string Job title.
     */
    public $title;

    /**
     * @var string Relative location.
     */
    public $location;

    /**
     * @var string Starting date for position.
     */
    public $from;

    /**
     * @var string Ending date for position, may be empty.
     */
    public $to;

    /**
     * @var array|string[] An array of paragraphs describing the position.
     */
    public $description = array();
}
