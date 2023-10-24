<?php

namespace App\models;
use App\models\Model;

    class Profile extends Model {
        private string $name;

        public static function fromMap(array $map): Profile {
            $profile = new self();
            $profile->setId($map['id']);
            $profile->setName($map['name']);

            return $profile;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }
    }