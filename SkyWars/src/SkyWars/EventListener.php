<?php

namespace SkyWars;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\Player;
use pocketmine\level\sound\GhastSound;
use pocketmine\level\particle\DustParticle;

class EventListener implements Listener {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onPlayerUse(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();

        if ($item->getId() === 86) { // Pumpkin used
            $player->getLevel()->addSound(new GhastSound($player));
            $player->getLevel()->addParticle(new DustParticle($player->asVector3(), 255, 127, 0)); // Orange particles
            $player->sendMessage("Boo! A spooky pumpkin!");
        }
    }
}