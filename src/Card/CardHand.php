<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    public array $hand = [];
    /**
     * Constructor
     * Object that holds Card objects.
     */
    public function __construct()
    {
        $this->hand = [];
    }
    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
    }
    /**
     * Loops through cards in hand, returns array of card symbols.
     */
    public function getCardSymbols(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getCardSymbol();
        }
        return $cards;
    }
    public function getCardStrings(): array
    {
        $cards = [];
        foreach ($this->hand as $card) {
            $cards[] = $card->getCardString();
        }
        return $cards;
    }
}
