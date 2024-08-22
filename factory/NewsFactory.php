<?php

namespace Factory;

use Class\News; // Ensure to use the fully qualified class name

class NewsFactory
{
    public function create(): News
    {
        return new News(); // Ensure to use fully qualified class name if not using autoloader
    }
}
