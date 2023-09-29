<?php

namespace App\models;

    class Profile {
        private int $id;
        private string $name;

        public static function fromMap(array $map): Profile {
            $profile = new self();
            $profile->setId($map['id']);
            $profile->setName($map['name']);

            return $profile;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }
    }