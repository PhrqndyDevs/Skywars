<?php

namespace SkyWars\Task;

use pocketmine\scheduler\Task;
use SkyWars\Main;

class DailyQuestTask extends Task {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        $this->plugin->getLogger()->info("Daily quests have been reset!");
        $this->plugin->getDailyMissions()->resetMissions();
    }
}
?>
