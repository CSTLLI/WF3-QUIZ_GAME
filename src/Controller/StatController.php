<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class StatController
 * @package App/Controller
 */

class StatController extends AbstractController
{
    #[Route('/Moyenne', name: 'app_stat')]
    public function index(): Response
    {
        
    

        return $this->render('Moyenne/stats.html.twig', [
            'controller_name' => 'StatController',
            'note' => '14'
        ]);

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                // Passage de type array en string
                function ($rolesArray) {
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                // Passage de type string en type array
                function ($rolesString) {
                    return [$rolesString];
                }
            ));


    }


    







    
}


