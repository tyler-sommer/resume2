<?php

namespace TylerSommer\Resume\Model;

/**
 * A Project is a personal project with links, images, and text.
 */
class Project
{
    /**
     * @var string The name of the project.
     */
    public $name;

    /**
     * @var string
     */
    public $blurb;

    /**
     * @var array|Link[] Links associated with the project.
     */
    public $links = array();

    /**
     * @var array|Image[] Images associated with the project.
     */
    public $images = array();

    /**
     * @var array|string[] An array of paragraphs describing the project.
     */
    public $description = array();
}
