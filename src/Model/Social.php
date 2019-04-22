<?php

namespace TylerSommer\Resume\Model;

/**
 * A Social is a hyperlink to some social network.
 */
class Social
{
    /**
     * @var string The URL this links to.
     */
    public $href;

    /**
     * @var string Name of the service.
     */
    public $name;

    /**
     * @var string Icon for the service.
     */
    public $icon;
}
