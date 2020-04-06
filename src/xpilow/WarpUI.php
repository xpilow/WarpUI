 <?php

namespace xpilow;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ExecutorCommand;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat as C;

use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;

use xpilow\form_by_jojoe\FormAPI;
use xpilow\form_by_jojoe\SimpleForm;
use xpilow\form_by_jojoe\CustomForm;
use xpilow\form_by_jojoe\ModalForm;
use xpilow\WarpUI;

class WarpUI extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info(C::GREEN . "[Enabled] Plugin WarpUI Aktif!");
    }

    public function onLoad(){
        $this->getLogger()->info(C::YELLOW . "[Loading] Plugin WarpUI Dalam Proses");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "[Disable] Plugin Terdapat Bug / Butuh FormAPI");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "warpui":
                if($sender instanceof Player){
                    if($sender->hasPermission("warp.ui")){
                        $this->Menu($sender);
                        return true;
                    }else{
                        $sender->sendMessage("§cMembutuh Kan Permissions!");
                        return true;
                    }

                }else{
                    $sender->sendMessage("§cGunakan Command Dalam Game!");
                    return true;
                }
            break;
            case "warpinfo":
			    if($sender instanceof Player) {
				    if($sender->hasPermission("warp.info")){
					    $sender->sendMessage("§b+-+-+-+-+-+-+-+-+§7[§eWarp§6Info§7]§b+-+-+-+-+-+-+-+-+");
					    $sender->sendMessage("§aAuthor §e: §bxpilow RezaG");
					    $sender->sendMessage("§aFollow IG §e: §b_rrza21");
					    $sender->sendMessage("§aYouTube §e: §bxpilow §fharap §cSubscribe");
					    $sender->sendMessage("§aPlugin ini §e: §bPrivate Simpanan");
					    $sender->sendMessage("§aServer IP §e: §bXpilowPMMP.mc-play.net§e:§b19215");
					    $sender->sendMessage("§aVersion §e: §b1.14.0 §aApi §e: §b3.0.0");
					    $sender->sendMessage("§aNama-Nama Sahabatku");
					    $sender->sendMessage("§b - §eNickyMcpeIndo12");
					    $sender->sendMessage("§b - §eBearIce08");
					    $sender->sendMessage("§b - §eRizkiRahmad8622");
					    $sender->sendMessage("§b - §eAlfian");
					    $sender->sendMessage("§b - §eAdamLightning");
					    $sender->sendMessage("§b - §eDan Saya §cRezaG §fMy GamerTag§e: §bxpilow21");
					    $sender->sendMessage("§b+-+-+-+-+-+-+-+-+§7[§eWarp§6Info§7]§b+-+-+-+-+-+-+-+-+");
					}
				}
        }
        return true;
    }

    public function Menu(Player $sender){
        $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $sender, array $data){
            $result = $data[0];
            if($result === null){
                return true;
            }
            if($result = 0){    $sender->sendMessage("Plugin buatan §aRezaG");
                 return true;
             }
             if($result = 1){    $this->World($sender);
                 return true;
             }
             if($result = 2){    $this->Lobby($sender);
             	return true;
             }
             if($result = 3){    $this->Survival($sender);  
                 return true;
             }
             if($result = 4){    $this->Mine($sender);  
                 return true;
             }
             if($result = 5){    $this->MyPlot($sender);  
                 return true;
             }
             if($result = 6){    $this->Games($sender);  
                 return true;
             }
             });
             $name = $sender->getName();
             $online = count($this->getServer()->getOnlinePlayers());
             $max = $this->getServer()->getMaxPlayers();
             $location = count($sender->getLevel()->getPlayers());
             $world = $sender->getLevel()->getName();
             $ping = $sender->getPing();
             $tps = $sender->getServer()->getTicksPerSecond();
             $wolf = $this->getServer()->getLevelByName("world");
             $spawn = count($wolf->getPlayers());
             $sheep = $this->getServer()->getLevelByName("lobby");
             $lobby = count($sheep->getPlayers());
             $gook = $this->getServer()->getLevelByName("survival");
             $survival = count($gook->getPlayers());
             $miaw = $this->getServer()->getLevelByName("mine");
             $mine = count($miaw->getPlayers());
             $myplot = $this->getServer()->getLevelByName("plot");
             $plot = count($myplot->getPlayers());
             $mgames = $this->getServer()->getLevelByName("games");
             $games = count($mgames->getPlayers());
             $form->setTitle("§5§kiii§r§eWarpUI §f| §aReza2175§5§kiii§r");
             $form->addDropdown("§b++++++++++++++++§e+§d++++++++++++++++\n§eHallo, §a{$name}\n §aOnline §e: §b{$online}\n §aMax Online §e: §b{$max}\n §aPlayers §e: §b{$location}\n §aSinyal §e: §b{$ping}\n §aTPS §e: §b{$tps}\n §aKamu Berada Di §e: §b{$world}\n§b++++++++++++++++§e+§d++++++++++++++++\n§rChoose World:", [
                 "§rPilih tujuan anda",
                 "§bWorld §ePlayers §a: §b$spawn",
                 "§bLobby §ePlayers §a: §b$lobby",
                 "§bSurvival §ePlayers §a: §b$survival",
                 "§bMining §ePlayers §a: §b$mine",
                 "§bMyPlot §ePlayers §a: §b$plot",
                 "§bMini Games §ePlayers §a: §b$games"
                 ]);
             $form->sendToPlayer($sender);
    }
    
    public function World($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
             $sender->teleport($this->getServer()->getLevelbyName("world")->getSafeSpawn());
	         $sender->sendMessage("§7[§eWarpUI§7] §f> §aTeleport Complete to §bWorld");
	                break;
	                case 2:
	                $sender->sendMessage("Plugin buatan §cxpilow");
	                break;
            }
        });
        $world = $sender->getLevel()->getName();
        $wolf = $this->getServer()->getLevelByName("world");
        $spawn = count($wolf->getPlayers());
        $form->setTitle("TELEPORT TO WORLD");
        $form->setContent("Apakah anda ingin ketempat lain khususnya dari\n §b{$world} §fke §bWorld");
        $form->setButton1("§a§kii§rCONFIRM§a§kii§r", 1);
        $form->setButton2("§c§kii§rCANCEL§c§kii§r", 2);
        $form->sendToPlayer($sender);
    }
    
    public function Lobby($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
             $sender->teleport($this->getServer()->getLevelbyName("lobby")->getSafeSpawn());
	         $sender->sendMessage("§7[§eWarpUI§7] §f> §aTeleport Complete to §bLobby");
	                break;
	                case 2:
	                $sender->sendMessage("Plugin buatan §cxpilow");
	                break;
            }
        });
        $world = $sender->getLevel()->getName();
        $sheep = $this->getServer()->getLevelByName("lobby");
        $lobby = count($sheep->getPlayers());
        $form->setTitle("TELEPORT TO LOBBY");
        $form->setContent("Apakah anda ingin ketempat lain khususnya dari\n §b{$world} §fke §bLobby");
        $form->setButton1("§a§kii§rCONFIRM§a§kii§r", 1);
        $form->setButton2("§c§kii§rCANCEL§c§kii§r", 2);
        $form->sendToPlayer($sender);
    }

    public function Survival($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
             $sender->teleport($this->getServer()->getLevelbyName("survival")->getSafeSpawn());
	         $sender->sendMessage("§7[§eWarpUI§7] §f> §aTeleport Complete to §bSurvival");
	                break;
	                case 2:
	                $sender->sendMessage("Plugin buatan §cxpilow");
	                break;
            }
        });
        $world = $sender->getLevel()->getName();
        $gook = $this->getServer()->getLevelByName("survival");
        $survival = count($gook->getPlayers());
        $form->setTitle("TELEPORT TO SURVIVAL");
        $form->setContent("Apakah anda ingin ketempat lain khususnya dari\n §b{$world} §fke §bSurvival");
        $form->setButton1("§a§kii§rCONFIRM§a§kii§r", 1);
        $form->setButton2("§c§kii§rCANCEL§c§kii§r", 2);
        $form->sendToPlayer($sender);
    }
    
    public function Mine($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
             $sender->teleport($this->getServer()->getLevelbyName("mine")->getSafeSpawn());
	         $sender->sendMessage("§7[§eWarpUI§7] §f> §aTeleport Complete to §bmine");
	                break;
	                case 2:
	                $sender->sendMessage("Plugin buatan §cxpilow");
	                break;
            }
        });
        $world = $sender->getLevel()->getName();
        $miaw = $this->getServer()->getLevelByName("mine");
        $mine = count($miaw->getPlayers());
        $form->setTitle("TELEPORT TO MINE");
        $form->setContent("Apakah anda ingin ketempat lain khususnya dari\n §b{$world} §fke §bMine");
        $form->setButton1("§a§kii§rCONFIRM§a§kii§r", 1);
        $form->setButton2("§c§kii§rCANCEL§c§kii§r", 2);
        $form->sendToPlayer($sender);
    }
    
    public function MyPlot($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
             $sender->teleport($this->getServer()->getLevelbyName("plot")->getSafeSpawn());
	         $sender->sendMessage("§7[§eWarpUI§7] §f> §aTeleport Complete to §bMyPlot");
	                break;
	                case 2:
	                $sender->sendMessage("Plugin buatan §cxpilow");
	                break;
            }
        });
        $world = $sender->getLevel()->getName();
        $myplot = $this->getServer()->getLevelByName("plot");
        $plot = count($myplot->getPlayers());
        $form->setTitle("TELEPORT TO MYPLOT");
        $form->setContent("Apakah anda ingin ketempat lain khususnya dari\n §b{$world} §fke §bMyPlot");
        $form->setButton1("§a§kii§rCONFIRM§a§kii§r", 1);
        $form->setButton2("§c§kii§rCANCEL§c§kii§r", 2);
        $form->sendToPlayer($sender);
    }

    public function Games($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
             $sender->teleport($this->getServer()->getLevelbyName("games")->getSafeSpawn());
	         $sender->sendMessage("§7[§eWarpUI§7] §f> §aTeleport Complete to §bMini Games");
	                break;
	                case 2:
	                $sender->sendMessage("Plugin buatan §cxpilow");
	                break;
            }
        });
        $world = $sender->getLevel()->getName();
        $mgames = $this->getServer()->getLevelByName("games");
        $games = count($mgames->getPlayers());
        $form->setTitle("TELEPORT TO GAMES");
        $form->setContent("Apakah anda ingin ketempat lain khususnya dari\n §b{$world} §fke §bMiniGames");
        $form->setButton1("§a§kii§rCONFIRM§a§kii§r", 1);
        $form->setButton2("§c§kii§rCANCEL§c§kii§r", 2);
        $form->sendToPlayer($sender);
    }
}
