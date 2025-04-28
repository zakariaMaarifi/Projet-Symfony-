<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UtilisateurController extends AbstractController{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UtilisateurController.php',
        ]);
    }
    #[Route('/acceuil', name: 'app_home')]
    public function acceuil(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
