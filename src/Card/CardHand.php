<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    protected array $hand = [];
    /**
     * Constructor
     * Object that holds Card objects.
     */
    public function __construct()
    {
        $this->hand = [];
    }
    /**
     * Appends a card object to the hand array.
     */
    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
    }
    public function getCardHand(): array
    {
        return $this->hand;
    }
    /**
     * Loops through cards in hand, returns array of card symbols.
     * @return array $cards
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
