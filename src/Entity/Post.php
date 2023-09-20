<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Uid\Uuid;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

    #[ORM\Entity(repositoryClass: PostRepository::class)]
    class Post
    {
        #[ORM\Id]
        //#[GeneratedValue(strategy: "UUID")
        //#[Column(type: "string", unique: true)]
        #[ORM\Column(type: "uuid", unique: true)]
        #[ORM\GeneratedValue(strategy: "CUSTOM")]
        #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
        private ?Uuid $id = null;
    
        #[ORM\Column(type: "string", length: 255)]
        private string $title;

        #[ORM\Column(type: "string", length: 255)]
        private string $content;

        #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
        private DateTime|null $createdAt = null;

        #[ORM\Column(name: "published_at", type: "datetime", nullable: true)]
        private DateTime|null $publishedAt = null;

        #[ORM\OneToMany(mappedBy: "post", targetEntity: Comment::class, cascade: ['persist', 'merge', "remove"], fetch: 'LAZY', orphanRemoval: true)]
        private Collection $comments;

        #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: "posts", cascade: ['persist', 'merge'], fetch: 'EAGER')]
        private Collection $tags;

        public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }
    
        /**
        * @return string
        */
        public function getId(): ?string
        {
            return $this->id;
        }

        /**
        * @param string $id
        */
        public function setId(string $id): self
        {
            $this->id = $id;
            return $this;
        }

        /**
        * @return string
        */
        public function getTitle(): string
        {
            return $this->title;
        }

        /**
        * @param string $title
        */
        public function setTitle(string $title): self
        {
            $this->title = $title;
            return $this;
        }

        /**
         * @return string
         */
        public function getContent(): string
        {
            return $this->content;
        }

        /**
         * @param string $content
         */
        public function setContent(string $content): self
        {
            $this->content = $content;
            return $this;
        }

        public function asArray(): array
        {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content
            ];
        }
    }
?>