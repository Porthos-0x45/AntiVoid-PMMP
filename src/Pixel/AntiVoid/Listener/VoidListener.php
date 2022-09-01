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
        $config = $this->plugin->config;

        if (($entity instanceof Player) && ($cause == EntityDamageEvent::CAUSE_VOID)) {
            $player = $event->getEntity();
            $plugin = $this->plugin;

            if ($plugin->config->exists("spawn") !== false) {
                $posX =       (float)$plugin->config->getNested("spawn")["posX"];
                $posY =       (float)$plugin->config->getNested("spawn")["posY"];
                $posZ =       (float)$plugin->config->getNested("spawn")["posZ"];
                $safe_spawn =        $plugin->config->getNested("spawn")["safe_spawn"];
            } else {
                $config->setNested("spawn.safe_spawn", true);
                $config->setNested("spawn.posX", 0);
                $config->setNested("spawn.posY", 0);
                $config->setNested("spawn.posZ", 0);
                $config->save();
            }


            if (!($safe_spawn)) {
                $player->teleport(new Position(
                    $posX,
                    $posY,
                    $posZ,
                    $player->getWorld()
                ));
            } else {
                $player->teleport($player->getWorld()->getSafeSpawn());
            }
        }
    }
}
