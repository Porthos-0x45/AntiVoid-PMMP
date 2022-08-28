<?php

declare(strict_types=1);

namespace Pixel\AntiVoid\Listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use Pixel\AntiVoid\Core\Main;
use pocketmine\math\Vector3;

class VoidListener implements Listener
{
    public $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onPlayerMove(PlayerMoveEvent $event)
    {
        $plugin = $this->plugin;
        $player = $event->getPlayer;
        $level = $plugin->config->get("world");

        if ($player->getY() < (float)$plugin->config->getNested("pos")["minY"]) {
            if (!($plugin->config->getNested("pos")["safe_spawn"])) {
                $player->teleport(new Vector3(
                    (float)$plugin->config->getNested("pos")["x"],
                    (float)$plugin->config->getNested("pos")["y"],
                    (float)$plugin->config->get("pos")["z"]
                ), $level);
            } else {
                $player->teleport($level->getSafeSpawn());
            }
        }
    }
}
