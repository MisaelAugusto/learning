<?php

namespace MisaelAugusto\GetCode;

use Github\Client;
use MisaelAugusto\GetCode\GithubCache;

class GithubClient
{
    private Client $client;

    private GithubCache $cache;

    public function __construct()
    {
      $this->client = new Client();
      $this->cache = new GithubCache();
    }

    public function fetchRepositories(string $username)
    {
      if ($this->cache->has($username))
      {
        $repositories = $this->cache->get($username);
      } else {        
        displayLoadingIndicator(loadingTitle: 'Fetching repositories...');
        
        $repositories = $this->client->user()->repositories($username);
        
      }
      
      $repositoriesNames = array_map(function ($repo) {
        return $repo['name'];
      }, $repositories);
      
      return $repositoriesNames;
    }
}
