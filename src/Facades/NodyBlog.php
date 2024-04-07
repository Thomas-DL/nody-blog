<?php

namespace Nody\NodyBlog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nody\NodyBlog\NodyBlog
 */
class NodyBlog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Nody\NodyBlog\NodyBlog::class;
    }
}
