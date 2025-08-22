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

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card_start")]
    public function home(
        SessionInterface $session
    ): Response {
        if ($session->has("card_deck")) {
            $currentDeck = $session->get("card_deck");
        } else {
            $currentDeck = new DeckOfCards();
        }
        if ($session->has("card_hand")) {
            $currentHand = $session->get("card_hand");
        } else {
            $currentHand = new CardHand();
        }

        $session->set("card_deck", $currentDeck);
        $session->set("card_hand", $currentHand);
        $session->set("cards_left", count($currentDeck->cardDeck));

        return $this->render('card/home.html.twig');
    }
    #[Route("/card/session", name: "session", methods: ['GET'])]
    public function session(
        SessionInterface $session
    ): Response {
        $sessionData = $session->all();
        return $this->render('/card/session.html.twig');
    }
    #[Route("/card/session_delete", name: "session_delete", methods: ['GET'])]
    public function delete(
        SessionInterface $session
    ): Response {

        $session->clear();

        $this->addFlash(
            'notice',
            'Session data has been deleted!'
        );

        return $this->redirectToRoute('session');
    }
    #[Route("/card/deck", name: "card_deck", methods: ['GET'])]
    public function deck(
        SessionInterface $session
    ): Response {

        $currentDeck = $session->get("card_deck");
        $currentHand = $session->get("card_hand");
        $sortedDeckArray = $currentDeck->sortDeck();
        $sortedDeckSymbols = [];
        foreach ($sortedDeckArray as $card) {
            $sortedDeckSymbols[] = $card->getCardSymbol();
        }
        $data = [
            "sorted_deck" => $sortedDeckSymbols
        ];

        return $this->render('/card/deck.html.twig', $data);
    }
    #[Route("/card/deck/shuffle", name: "shuffle", methods: ['GET'])]
    public function shuffle(
        SessionInterface $session
    ): Response {

        $newDeck = new DeckOfCards();
        $newDeck->shuffleDeck();
        $session->set("card_deck", $newDeck);

        $data = [
            "card_deck" => $session->get("card_deck")->getCardSymbols()
        ];

        return $this->render('/card/shuffle.html.twig', $data);
    }
    #[Route("/card/deck/draw", name: "draw", methods: ['GET'])]
    public function draw(
        SessionInterface $session
    ): Response {

        $currentDeck = $session->get("card_deck");
        $currentHand = $session->get("card_hand");
        $cardsLeft = $session->get("cards_left");

        $drawnCards = [];
        $drawnCard = array_pop($currentDeck->cardDeck);
        $currentHand->addCard($drawnCard);
        $drawnCards[] = $drawnCard->getCardSymbol();
        $session->set("card_hand", $currentHand);
        $session->set("card_deck", $currentDeck);
        $session->set("cards_left", count($currentDeck->cardDeck));
        $data = [
            "drawn_cards" => $drawnCards,
            "card_hand" => $session->get("card_hand")->getCardSymbols(),
            "card_deck" => $session->get("card_deck")->getCardSymbols()
        ];
        return $this->render('/card/draw.html.twig', $data);
    }
    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_number", methods: ['GET'])]
    public function drawNumber(
        int $num,
        Request $request,
        SessionInterface $session
    ): Response {

        $numberCards = $request->query->get('num_cards', 1);

        $currentDeck = $session->get("card_deck");
        $currentHand = $session->get("card_hand");

        $drawnCards = [];
        for ($i = 1; $i <= $numberCards; $i++) {
            $drawnCard = array_pop($currentDeck->cardDeck);
            $currentHand->addCard($drawnCard);
            $drawnCards[] = $drawnCard->getCardSymbol();
        }

        $session->set("card_deck", $currentDeck);
        $session->set("card_hand", $currentHand);
        $session->set("cards_left", count($currentDeck->cardDeck));

        $data = [
            "drawn_cards" => $drawnCards,
            "card_deck" => $session->get("card_deck")->getCardSymbols(),
            "card_hand" => $session->get("card_hand")->getCardSymbols()
        ];

        return $this->render('/card/draw.html.twig', $data);
    }
}
