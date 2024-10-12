<?php

namespace SkyWars;

use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Item;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;

class OreDrops implements Listener {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onBlockBreak(BlockBreakEvent $event): void {
        $player = $event->getPlayer();
        $block = $event->getBlock();

        $drops = $this->getOreDrops($block, $player);

        if (!empty($drops)) {
            $event->setDrops($drops);
            foreach ($drops as $drop) {
                $player->getInventory()->addItem($drop);
            }
        }
    }

    private function getOreDrops(Block $block, Player $player): array {
        $drops = [];

        switch ($block->getId()) {
            case BlockLegacyIds::REDSTONE_ORE:
                // Giving 1 heart (extra health)
                $player->setHealth(min($player->getMaxHealth(), $player->getHealth() + 2)); // 1 heart is 2 health points
                break;
            case BlockLegacyIds::DIAMOND_ORE:
                $drops[] = Item::get(Item::DIAMOND_CHESTPLATE); // Diamond armor piece
                if (mt_rand(0, 1)) {
                    $drops[] = Item::get(Item::COBWEB); // Sometimes drop cobwebs
                }
                break;
            case BlockLegacyIds::IRON_ORE:
                $drops[] = Item::get(Item::IRON_BLOCK);
                $drops[] = Item::get(Item::PUMPKIN); // Special Pumpkin
                break;
            case BlockLegacyIds::GOLD_ORE:
                $goldSword = Item::get(Item::GOLD_SWORD);
                $goldSword->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FIRE_ASPECT), 1)); // Enchanted with Fire Aspect
                $drops[] = $goldSword;
                $drops[] = Item::get(Item::COBWEB);
                $drops[] = Item::get(Item::IRON_CHESTPLATE); // Iron or gold armor
                break;
            // Add more cases for different ores and their drops
        }

        return $drops;
    }
}
