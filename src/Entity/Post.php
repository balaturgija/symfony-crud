<?php
namespace App\Entity;

    class Post
    {
        private ?string $id = null;
    
        private string $title;
    
        private string $content;
    
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