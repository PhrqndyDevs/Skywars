<?php

namespace SkyWars\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use SkyWars\Main;

class JoinCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("join", "Join a SkyWars game");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage("This command can only be used in-game.");
            return false;
        }

        $playerManager = $this->plugin->getPlayerManager();
        if ($playerManager->isInGame($sender)) {
            $sender->sendMessage("You are already in a game!");
            return false;
        }

        $playerManager->addPlayerToGame($sender);
        $sender->sendMessage("You have joined the SkyWars game!");
        return true;
    }
}
?>
