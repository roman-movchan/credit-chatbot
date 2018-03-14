<?php

namespace App\Controller;

use App\Conversation\CreditConversation;
use App\Service\BotService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\Drivers\Web\WebDriver;

class ChatbotController extends Controller
{
    /**
     * @Route("/message", name="message")
     */
    public function index(BotService $botService)
    {
        $cacheAdapter = new FilesystemAdapter();
        DriverManager::loadDriver(WebDriver::class);
        $botman = BotManFactory::create([], new SymfonyCache($cacheAdapter));

        $botman->hears('(hello|hi|hey)', function (BotMan $bot) use ($botService) {
            $bot->startConversation(new CreditConversation());
        });

        $botman->listen();
        return new Response();
    }
}
