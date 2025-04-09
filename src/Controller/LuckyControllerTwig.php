<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/lucky/twig", name: "lucky")]
    public function number(): Response
    {
        $number = random_int(1, 13);

        $blocks = [
            1 => ['name' => 'Bookshelf', 'personality' => 'resourceful and wise'],
            2 => ['name' => 'Bricks', 'personality' => 'a lot of work'],
            3 => ['name' => 'Cobblestone', 'personality' => 'underrated by most'],
            4 => ['name' => 'Crafting table', 'personality' => 'very handy and generally good to have around'],
            5 => ['name' => 'Grass block', 'personality' => 'unassuming but important'],
            6 => ['name' => 'Mossy cobblestone', 'personality' => 'hiding secret treasure (and danger)'],
            7 => ['name' => 'Mossy stone brick', 'personality' => 'elegant and classy'],
            8 => ['name' => 'Oak log', 'personality' => 'sturdy, unpolished, strong'],
            9 => ['name' => 'Oak planks', 'personality' => 'rustic but classic'],
            10 => ['name' => 'Sandstone', 'personality' => 'solid-looking but lightweight'],
            11 => ['name' => 'Snowy dirt', 'personality' => 'dirt with snow on it'],
            12 => ['name' => 'Stone', 'personality' => 'strong and reliable'],
            13 => ['name' => 'TNT', 'personality' => 'explosive']
        ];

        $blockFacts = $blocks[$number];

        $data = [
            'number' => $number,
            'blockName' => $blockFacts['name'],
            'blockPersonality' => $blockFacts['personality']
        ];

        return $this->render('lucky.html.twig', $data);
    }
}