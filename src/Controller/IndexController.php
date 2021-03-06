<?php

namespace App\Controller;


use App\Entity\Hotel;
use App\Service\DateCalculator;
use App\Service\RandomNumberGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{

    private const HOTEL_OPENED = 1969;

    /**
     * @Route("/")
     */
    public function home(LoggerInterface $logger, DateCalculator $dateCalculator)
    {
        $logger->info('Homepage loaded');
        //$year = $randomNumberGenerator->getRandomNumber();
        $year = $dateCalculator->yearsDiffrence(self::HOTEL_OPENED);

        $hotels =  $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->findAllBelowPrice(750);

        $images = [
            ['url' => 'images/hotel/intro_room.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_pool.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_dining.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_attractions.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_wedding.jpg', 'class' => 'hidesm']
        ];

        return $this->render('index.html.twig',
            ['year' => $year, 'images' => $images, 'hotels' => $hotels]
        );
    }
}
