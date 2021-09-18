<?php

namespace TylerSommer\Resume\Model;

/**
 * A Qualification represents a skill or knowledge.
 */
class Qualification
{
    /**
     * @var string Name of qualification.
     */
    public $name;

    /**
     * @var string Type of qualification. One of: language, platform.
     */
    public $type;

    /**
     * @var boolean If this qualification could use some improvement.
     */
    public $rusty = false;
}
