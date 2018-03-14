<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use App\Service\BotService;
use BotMan\Drivers\Web\WebDriver;

class FacebookController extends Controller
{
    /**
     * @Route("/fbbot", name="facebook")
     */
    public function index(BotService $botService)
    {
        DriverManager::loadDriver(WebDriver::class);
        $botman = BotManFactory::create([]);

        $botman->hears('(hello|hi|hey)', function (BotMan $bot) use ($botService) {
            $bot->reply($botService->handleHello());
        });

        $botman->hears('(what night|when) is club night.*', function (BotMan $bot) use ($botService) {
            $bot->reply($botService->handleClubNights());
        });

        $botman->listen();
        return new Response();
    }
}
