<?php

class File implements Content
{
    public function __construct(
        public readonly string $name,
        public readonly string $content
    ) {
    }
}
