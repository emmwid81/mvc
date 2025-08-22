<?php

namespace App\Card;

class Card
{
    private string $suitName;
    private int $cardValue;
    private string $cardName;
    private string $suitSymbol;
    private int $cardNumber;
    private array $cardNames = ["A", "2", "3", "4", "5", "6", "7",
    "8", "9", "10", "J", "Q", "K"];
    private array $suitSymbols = [
        "spades" => "&#9824;",
        "hearts" => "&#9825;",
        "diamonds" => "&#9826;",
        "clubs" => "&#9827;"
    ];
    /**
     * Constructor
     * @var null|string $suitName Clubs, diamonds, hearts or spades.
     * @var null|integer $cardValue Numeric cardValue of card (1-13)
     */
    public function __construct(string $suitName = null, int $cardValue = null, int $suitNumber = null)
    {
        $this->suitName = $suitName;
        $this->cardValue = $cardValue;
        $this->cardNumber = $this->cardValue + $suitNumber;
        $this->cardName = $this->cardNames[$this->cardValue - 1];
        $this->suitSymbol = html_entity_decode($this->suitSymbols[$suitName]);
    }

    public function getCardValue(): int
    {
        return $this->cardValue;
    }
    public function getCardNumber(): int
    {
        return $this->cardNumber;
    }
    public function getCardString(): string
    {
        return "{$this->cardName} of {$this->suitName}";
    }
    public function getCardSymbol(): string
    {
        return "{$this->suitSymbol} {$this->cardName}";
    }
}
