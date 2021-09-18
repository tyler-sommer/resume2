<?php

namespace TylerSommer\Resume\Model;

/**
 * A Link is a hyperlink to some other web page.
 */
class Link
{
    /**
     * @var string The URL this links to.
     */
    public $href;

    /**
     * @var string An optional icon.
     */
    public $icon;

    /**
     * @var string Text describing the link.
     */
    public $text;
}
