<?php

declare(strict_types=1);

namespace Pixel\AntiVoid\Core;

use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Pixel\AntiVoid\Listener\VoidListener;

class Main extends PluginBase
{
    public $config;

    public function onLoad(): void
    {
        $this->getServer()->getLogger()->info(TextFormat::RED . "I NEED SLEEEEP!!!!!!!!!!!!!");
    }

    public function onEnable(): void
    {
        $this->getServer()->getLogger()->info(TextFormat::RED . "I NEED SLEEEEP!!!!!!!!!!!!!");

        $this->getServer()->getPluginManager()->registerEvents(new VoidListener($this), $this);
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $player = $this->getServer->getPlayer($sender->getName());
        $serv = $this->getServer;
        $nocmd = TextFormat::RED . "You do not have permission to use this command";
        $notother = TextFormat::RED . "You do not have permission to change the gamemode of other players";

        switch ($command->getName()) {
            case "gms":
                if ($sender->hasPermission("gms.command")) {
                    if (count($args) < 1) {
                        $sender->sendMessage("Gamemode changed to Survival Mode");
                        $player->setGamemode(0);
                    }
                    if (isset($args[0])) {
                        $subject = $serv->getPlayer($args[0]);
                        if ($sender->hasPermission("gms.other")) {
                            $subject->setGamemode(0);
                            $sender->sendMessage("Changed " . $subject->getName() . "'s gamemode to Survival mode");
                            $subject->sendMessage("Your gamemode was changed to Survival Mode");
                        } else {
                            $sender->sendMessage($notother);
                            return true;
                        }
                    }
                } else {
                    $sender->sendMessage($nocmd);
                }
                break;

            case "gmc":
                if ($sender->hasPermission("gmc.command")) {
                    if (count($args) < 1) {
                        $sender->sendMessage("Gamemode changed to Creative Mode");
                        $player->setGamemode(1);
                    }
                    if (isset($args[0])) {
                        $subject = $serv->getPlayer($args[0]);
                        if ($sender->hasPermission("gmc.other")) {
                            $subject->setGamemode(1);
                            $sender->sendMessage("Changed " . $subject->getName() . "'s gamemode to Creative mode");
                            $subject->sendMessage("Your gamemode was changed to Creative Mode");
                        } else {
                            $sender->sendMessage($notother);
                            return true;
                        }
                    }
                } else {
                    $sender->sendMessage($nocmd);
                }
                break;

            case "gma":
                if ($sender->hasPermission("gma.command")) {
                    if (count($args) < 1) {
                        $sender->sendMessage("Gamemode changed to Adventure Mode");
                        $player->setGamemode(1);
                    }
                    if (isset($args[0])) {
                        $subject = $serv->getPlayer($args[0]);
                        if ($sender->hasPermission("gma.other")) {
                            $subject->setGamemode(1);
                            $sender->sendMessage("Changed " . $subject->getName() . "'s gamemode to Adventure mode");
                            $subject->sendMessage("Your gamemode was changed to Adventure Mode");
                        } else {
                            $sender->sendMessage($notother);
                            return true;
                        }
                    }
                } else {
                    $sender->sendMessage($nocmd);
                }
                break;

            case "gmspc":
                if ($sender->hasPermission("gmspc.command")) {
                    if (count($args) < 1) {
                        $sender->sendMessage("Gamemode changed to Spectator Mode");
                        $player->setGamemode(3);
                    }
                    if (isset($args[0])) {
                        $subject = $serv->getPlayer($args[0]);
                        if ($sender->hasPermission("gmspc.other")) {
                            $subject->setGamemode(3);
                            $sender->sendMessage("Changed " . $subject->getName() . "'s gamemode to Spectator mode");
                            $subject->sendMessage("Your gamemode was changed to Spectator Mode");
                        } else {
                            $sender->sendMessage($notother);
                            return true;
                        }
                    }
                } else {
                    $sender->sendMessage($nocmd);
                }
                break;
        }
        return true;
    }
}
