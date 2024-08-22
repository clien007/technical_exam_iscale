<?php

namespace App\Factory;

use App\Model\News; // Ensure to use the fully qualified class name

class NewsFactory
{
    public function create(): News
    {
        return new News(); // Ensure to use fully qualified class name if not using autoloader
    }
}
