<?php

namespace MisaelAugusto\GetCode;

class GithubCache
{
    public readonly array $data;

    public function __construct()
    {
        $data = file_get_contents('data.json');

        $decodedData = json_decode($data, true);

        $this->data = $decodedData;
    }

    public function has(string $username): bool
    {
        return isset($this->data[$username]);
    }

    public function get(string $username): array
    {
       return $this->data[$username];
    }
}
