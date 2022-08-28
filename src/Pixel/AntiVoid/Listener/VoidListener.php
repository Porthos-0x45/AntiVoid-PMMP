<?php

declare(strict_types=1);

namespace Pixel\AntiVoid\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use Pixel\AntiVoid\Core\Main;
use pocketmine\math\Vector3;
use pocketmine\world\Position;
use pocketmine\world\World;

class VoidListener implements Listener
{
    public function __construct(private Main $plugin)
    {
    }

    public function onPlayerMove(PlayerMoveEvent $event): void
    {
        $plugin = $this->plugin;
        $player = $event->getPlayer();
        $level = $plugin->config->get("world");


        if ($player->getPosition()->y < (float)$plugin->config->getNested("pos")["minY"]) {
            if (!($plugin->config->getNested("pos")["safe_spawn"])) {
                $player->teleport(new Position(
                    (float)$plugin->config->getNested("pos")["x"],
                    (float)$plugin->config->getNested("pos")["y"],
                    (float)$plugin->config->get("pos")["z"],
                    $level
                ));
            } else {
                $player->teleport($player->getWorld()->getSafeSpawn());
            }
        }
    }
}
