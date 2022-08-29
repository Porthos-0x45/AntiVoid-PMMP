<?php

declare(strict_types=1);

namespace Pixel\AntiVoid\Listener;

use pocketmine\event\Listener;
use Pixel\AntiVoid\Core\Main;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\player\Player;
use pocketmine\world\Position;

class VoidListener implements Listener
{
    public function __construct(private Main $plugin)
    {
    }

    public function onPlayerDamage(EntityDamageEvent $event)
    {
        $entity = $event->getEntity();
        $cause = $event->getCause();

        if (($entity instanceof Player) && ($cause == EntityDamageEvent::CAUSE_VOID)) {
            $player = $event->getEntity();
            $plugin = $this->plugin;
            $minY = (float)$plugin->config->getNested("spawn")["minY"];

            print($minY);


            if ($player->getPosition()->y < $minY) {
                if (!($plugin->config->getNested("spawn")["safe_spawn"])) {
                    $player->teleport(new Position(
                        (float)$plugin->config->getNested("spawn")["posX"],
                        (float)$plugin->config->getNested("spawn")["posY"],
                        (float)$plugin->config->getNested("spawn")["posZ"],
                        $player->getWorld()
                    ));
                } else {
                    $player->teleport($player->getWorld()->getSafeSpawn());
                }
            }
        }
    }
}
