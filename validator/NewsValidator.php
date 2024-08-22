<?php

namespace Validator;

class NewsValidator
{
    /**
     * Validates the title and body for a news item.
     *
     * @param string $title
     * @param string $body
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validate(string $title, string $body): void
    {
        $this->validateTitle($title);
        $this->validateBody($body);
    }

    /**
     * Validates the title.
     *
     * @param string $title
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateTitle(string $title): void
    {
        if (empty($title) || strlen($title) > 255) {
            throw new \InvalidArgumentException('Title must not be empty and cannot exceed 255 characters.');
        }
    }

    /**
     * Validates the body.
     *
     * @param string $body
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateBody(string $body): void
    {
        if (empty($body)) {
            throw new \InvalidArgumentException('Body must not be empty.');
        }
    }
}
