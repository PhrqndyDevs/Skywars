<?php

namespace SkyWars;

class Arena {
    private $name;
    private $spawnPoints = [];
    private $center;
    private $maxPlayers;
    private $minPlayers;

    public function __construct(array $data) {
        $this->name = $data['name'];
        $this->spawnPoints = $data['spawnpoints'];
        $this->center = $data['center'];
        $this->maxPlayers = $data['8'];
        $this->minPlayers = $data['2'];
    }

    public function getName(): string {
        return $this->name;
    }

    // Add other methods to manage the arena
}