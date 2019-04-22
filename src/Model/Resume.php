<?php

namespace TylerSommer\Resume\Model;

/**
 * A Resume is a type describing a person and their work experience.
 */
class Resume
{
    /**
     * @var string The person's name.
     */
    public $name;

    /**
     * @var string Contact phone number.
     */
    public $phone;

    /**
     * @var string Contact email address.
     */
    public $email;

    /**
     * @var string Self-appointed title.
     */
    public $title;

    /**
     * @var array|string[] Array of paragraphs providing a short introduction or objective statement.
     */
    public $description = array();

    /**
     * @var array|string[] An array of paragraphs providing a short-form biography.
     */
    public $profile = array();

    /**
     * @var array|Position[] An array of professional work positions.
     */
    public $experience = array();

    /**
     * @var array|Project[] An array of professional and personal projects.
     */
    public $projects = array();

    /**
     * @var array|string[] An array of extra miscellaneous experience to include.
     */
    public $extra = array();

    /**
     * @var array|Qualification[] An array of skills and qualifications.
     */
    public $qualifications = array();
    
    /**
     * @var array|Social[] An array of links to social networks and such.
     */
    public $social = array();
}
