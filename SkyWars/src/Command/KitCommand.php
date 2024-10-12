<?php

namespace SkyWars\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use SkyWars\Main;

class KitCommand extends Command
{
    private $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("kit", "Select a kit");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args)
    {
        // ...
    }
}