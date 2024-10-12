<?php

namespace SkyWars\Utils;

use pocketmine\Player;
use pocketmine\form\Form;
use pocketmine\form\FormApi;
use SkyWars\Main;

class UI {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function showStats(Player $player) {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) return;
            // Handle form response
        });

        $form->setTitle("Player Stats");
        $form->setContent("Wins: " . $this->plugin->getPlayerManager()->getWins($player) . "\n"
                         ."Kills: " . $this->plugin->getPlayerManager()->getKills($player) . "\n"
                         ."Level: " . $this->plugin->getPlayerManager()->getLevel($player));
        $form->addButton("Close");

        $player->sendForm($form);
    }

    public function showDailyMissions(Player $player) {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) return;
            // Handle form response
        });

        $form->setTitle("Daily Missions");
        $form->setContent("Complete these missions to earn rewards!");
        $missions = $this->plugin->getDailyMissions()->getMissionsForPlayer($player);
        foreach ($missions as $mission) {
            $form->addButton($mission->getDescription());
        }
        $form->addButton("Close");

        $player->sendForm($form);
    }
}
?>
