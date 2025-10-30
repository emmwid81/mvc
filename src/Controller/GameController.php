<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameController extends AbstractController
{
    #[Route("game/", name: "game_start")]
    public function home(
        SessionInterface $session
    ): Response {
        $session->set("hej", "hejhej");
        return $this->render('game/home.html.twig');
    }
    #[Route("game/doc", name: "documentation")]
    public function docs(): Response {
        return $this->render('game/doc.html.twig');
    }
    #[Route("game/play", name: "play")]
    public function play(
        SessionInterface $session
    ): Response {
        $session->set();

        $game = new TwentyOneGame();
        return $this->render('game/play.html.twig');
    }
}
