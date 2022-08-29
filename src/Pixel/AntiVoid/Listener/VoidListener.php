<?php

declare(strict_types=1);

namespace Pixel\AntiVoid\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use Pixel\AntiVoid\Core\Main;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\world\World;

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

            if ($player->getPosition()->y < (float)$plugin->config->getNested("pos")["minY"]) {
                if (!($plugin->config->getNested("pos")["safe_spawn"])) {
                    $player->teleport(new Position(
                        (float)$plugin->config->getNested("pos")["x"],
                        (float)$plugin->config->getNested("pos")["y"],
                        (float)$plugin->config->getNested("pos")["z"],
                        $player->getWorld()
                    ));
                } else {
                    $player->teleport($player->getWorld()->getSafeSpawn());
                }
            }
        }
    }
}
