<?php

namespace SkyWars;

class Game {
    private $plugin;
    private $players = [];
    private $arena;

    public function __construct(Main $plugin, Arena $arena) {
        $this->plugin = $plugin;
        $this->arena = $arena;
    }

    public function start() {
        // Logic to start the game
    }

    public function end() {
        // Logic to end the game
    }
}