<?php

namespace App\models;
use App\models\Model;

    class Module extends Model {

        private string $name;

        public static function fromMap(array $map): Module {
            $module = new self();
            $module->setId($map['id']);
            $module->setName($map['name']);

            return $module;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }
    }