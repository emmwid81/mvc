<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerJson //checkpoint
{
    #[Route("/api/quote", name: "quote")]
    public function jsonQuote(): Response
    {
        date_default_timezone_set('Europe/Stockholm');
        $number = random_int(0, 4);
        $today = date('Y-m-d');
        $now = date('H:i:s');

        $quotes = [
            0 => 'The problems of racial injustice and economic injustice cannot be solved without a radical redistribution of political and economic power. - Martin Luther King Jr',
            1 => 'The paradise of the rich is made out of the hell of the poor. - Victor Hugo',
            2 => 'What is called "capitalism" is basically a system of corporate mercantilism, with huge and
largely unaccountable private tyrannies exercising vast control over the economy, political systems,
and social and cultural life, operating in close cooperation with powerful states that intervene massively in the
domestic economy and international society. - Noam Chomsky',
            3 => 'In a racist society it is not enough to be non-racist, we must be anti-racist. - Angela Davis',
            4 => 'The imperialist capitalist class will move heaven and hell against the proletariat. It will turn the country
into a smoking heap of rubble rather than give up wage-slavery of its own free will. - Rosa Luxemburg'
        ];

        $randomQuote = $quotes[$number];

        $data = [
            'quote' => $randomQuote,
            'date' => $today,
            'time' => $now
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
