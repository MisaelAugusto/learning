<?php

class Directory implements Content
{
    public function __construct(
        public readonly string $name,
        public readonly array $contents
    ) {
    }
}
