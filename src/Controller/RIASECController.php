<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RIASECController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        $datas = json_decode(file_get_contents($this->getParameter('kernel.project_dir') . '/public/datas/RIASEC.json'));

        return $this->render('riasec/index.html.twig', [
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/result")
     */
    public function result(Request $request): Response
    {
        $answerCount = array_count_values($request->get('riasec'));
        arsort($answerCount);

        return $this->render('riasec/result.html.twig', [
            'resultFirst' => array_keys($answerCount)[0],
            'resultSecond' => array_keys($answerCount)[1],
        ]);
    }

    /**
     * @Route("/RIASEC/data")
     */
    public function data(): Response
    {
        $data = file_get_contents($this->getParameter('kernel.project_dir') . '/public/datas/RIASEC.json');
        return JsonResponse::fromJsonString($data);
    }
}
