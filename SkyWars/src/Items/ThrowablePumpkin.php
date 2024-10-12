<?php

namespace SkyWars\Items;

use pocketmine\entity\projectile\Snowball;
use pocketmine\entity\projectile\Throwable;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\Player;
use pocketmine\level\particle\HugeExplodeSeedParticle;
use pocketmine\level\Position;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

class ThrowablePumpkin extends Snowball {

    protected $gravity = 0.05;
    protected $drag = 0.01;

    public function onHit(ProjectileHitEvent $event): void {
        $position = $this->getPosition();
        $this->getLevel()->addParticle(new HugeExplodeSeedParticle($position));

        // Apply effects
        foreach ($this->getLevel()->getNearbyEntities($this->getBoundingBox()->expandedCopy(3, 3, 3)) as $entity) {
            if ($entity instanceof Player) {
                $entity->addEffect(new EffectInstance(Effect::getEffect(Effect::BLINDNESS), 100, 1));
            }
        }

        // Spawn cobwebs
        $this->spawnCobwebs($position);
    }

    private function spawnCobwebs(Position $position): void {
        for ($x = -1; $x <= 1; $x++) {
            for ($y = -1; $y <= 1; $y++) {
                for ($z = -1; $z <= 1; $z++) {
                    $blockPos = $position->add($x, $y, $z);
                    if ($this->getLevel()->getBlock($blockPos)->getId() === 0) { // Check if air
                        $this->getLevel()->setBlock($blockPos, Item::get(Item::COBWEB)->getBlock(), true);
                    }
                }
            }
        }
    }
}