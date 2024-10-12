<?php

namespace SkyWars;

use pocketmine\Player;

class PlayerManager {

    private $playersInGame = [];

    public function isInGame(Player $player): bool {
        return isset($this->playersInGame[$player->getName()]);
    }

    public function addPlayerToGame(Player $player): void {
        $this->playersInGame[$player->getName()] = $player;
        // Additional logic to handle joining the game
    }

    public function removePlayerFromGame(Player $player): void {
        unset($this->playersInGame[$player->getName()]);
        // Additional logic to handle leaving the game
    }
}
?>
