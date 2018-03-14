<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteController extends Controller
{
    /**
     * @Route("/", name="website")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'title' => 'Credit Chat Bot'
        ]);
    }
}
