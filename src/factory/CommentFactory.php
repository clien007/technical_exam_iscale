<?php

namespace App\Factory;

use App\Class\Comment; // Ensure correct namespace for the Comment class

class CommentFactory
{
    public function create(): Comment
    {
        return new Comment(); // Use the fully qualified class name if not using autoloader
    }
}
