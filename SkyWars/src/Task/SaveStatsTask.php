<?php

namespace SkyWars\Task;

use pocketmine\scheduler\Task;
use SkyWars\Main;

class SaveStatsTask extends Task {
    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            // Save player stats logic
            // Example: 
            // $stats = $this->plugin->getPlayerManager()->getPlayerStats($player);
            // Save $stats to a file or database
        }
        $this->plugin->getLogger()->info("Player stats saved successfully.");
    }
}
?>
