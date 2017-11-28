<?php

namespace TylerSommer\Resume\Model;

/**
 * An Image is an image resource with title and description.
 */
class Image
{
    /**
     * @var string A valid URI for an image resource.
     */
    public $src;

    /**
     * @var string Alternate text if the image fails or cannot load.
     */
    public $alt;

    /**
     * @var string The title of the image, shown on hover.
     */
    public $title;

    /**
     * @var string The text caption for the image.
     */
    public $text;
}
