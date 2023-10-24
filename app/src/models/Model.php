<?php

namespace App\models;

    class Model {

        private string $id;
        private string $created_at;
        private string $updated_at;
        private string $deleted_at;

        public function setId(string $id): void { 
            $this->id = $id;
        }

        public function setCreated_at(string $date): void {
            $this->created_at = $date;
        }

        public function setUpdated_at(string $date): void {
            $this->updated_at = $date;
        }

        public function setDeleted_at(string $date): void {
            $this->deleted_at = $date;
        }

        public function getId(): string {
            return $this->id;
        }

        public function getCreated_at(): string {
            return $this->created_at;
        }
        
        public function getUpdate_at(): string {
            return $this->updated_at;
        }

        public function getDeleted_at(): string {
            return $this->deleted_at;
        }
    }