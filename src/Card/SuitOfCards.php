<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardHand;

class SuitOfCards extends CardHand
{
    public string $suitName;
    public function __construct(string $suitName, int $suitValue)
    {
        parent::__construct();
        $this->suitName = $suitName;
        $this->suitValue = $suitValue;
        $this->createSuit();
    }
    public function createSuit(): array
    {
        for ($i = 1; $i <= 13; $i++) {
            $this->addCard(new Card($this->suitName, $i, $this->suitValue));
        }
        return $this->hand;
    }
}
