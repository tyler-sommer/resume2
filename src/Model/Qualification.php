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
     * @var string Type of qualification. One of: strength, needs-improvement, platform.
     */
    public $type;
}
