<?php

namespace SkyWars\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use SkyWars\Main;

class JoinCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("join", "Join a SkyWars game");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        // Join game logic
        return true;
    }
}

