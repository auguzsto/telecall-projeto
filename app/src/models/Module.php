<?php

namespace App\models;

    class Module {
        
        private int $id;
        private string $name;

        public static function fromMap(array $map): Module {
            $module = new self;
            $module->setId($map['id']);
            $module->setName($map['name']);

            return $module;
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