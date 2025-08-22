<?php

namespace App\Card;

use App\Card\Card;
use App\Card\SuitOfCards;

class DeckOfCards
{
    /**
     * @var array $cardDeck an array of card objects.
     * @var array $sortedDeck copy of cardDeck but sorted by suit and value.
     */
    public array $cardDeck = [];
    /**
     * Constructor
     * Makes a suit of cards for each suit name and merges them into a full deck.
     * Default suit is normal 52 card deck.
     */
    public function __construct(array $suits = ["spades", "hearts", "diamonds", "clubs"])
    {
        $suitValue = 0;
        foreach ($suits as $suit) {
            $cardSuit = new SuitOfCards($suit, $suitValue);
            $this->cardDeck = [...$this->cardDeck, ...$cardSuit->getCardHand()];
            $suitValue += 100;
        }
    }
    /**
     * @return array An array of the cards as symbols.
     */
    public function getCardSymbols(array $cards = null): array
    {
        if ($cards === null) {
            $cards = $this->cardDeck;
        }

        $cardSymbols = [];

        foreach ($cards as $card) {
            $cardSymbols[] = $card->getCardSymbol();
        }

        return $cardSymbols;
    }
    /**
     * Shuffles the card objects in the cardDeck array.
     */
    public function shuffleDeck()
    {
        shuffle($this->cardDeck);
    }
    /**
     * Returns a sorted copy of all cards in deck.
     * Sorts by card number which is the cards individual number
     * appointed to it when created. The number is the card value plus
     * the suite value.
     * @return array $sortedDeck
     */
    public function sortDeck(): array
    {
        $sortedDeck = $this->cardDeck;

        usort($sortedDeck, function (Card $a, Card $b) {
            return $a->getCardNumber() <=> $b->getCardNumber();
        });
        return $sortedDeck;
    }
}
