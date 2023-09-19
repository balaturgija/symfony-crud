<?php

namespace App\Controller;

use App\Entity\PostFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

    #[Route(path: "/posts", name: "posts_")]
    class PostController extends AbstractController
    {
        #[Route(path: "", name: "all", methods: ["GET"])]
        function all(): Response
        {
            $post1 = PostFactory::create("test title", "test content");
            $post1->setId("1");

            $post2 = PostFactory::create("test title", "test content");
            $post2->setId("2");

            $data = [$post1->asArray(), $post2->asArray()];
            return $this->json($data, 200, ["Content-Type" => "application/json"]);
            //return $this->json($data, 200, ["Content-Type" => "application/json"])
        }
    }
?>