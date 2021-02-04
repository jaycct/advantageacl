<?php

namespace jaycct\advantageacl;
use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class AdvantageaclEvents extends Component
{
   public static function postUpdate(Event $event)
   {
        $composer = $event->getComposer();
		dd($composer);
   }

    public static function postAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
		echo $vendorDir;
        require $vendorDir . '/autoload.php';
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
		dd($installedPackage);
        // do stuff
    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }
}
