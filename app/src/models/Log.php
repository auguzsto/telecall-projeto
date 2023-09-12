<?php

namespace App\models;

    class Log {
        
        private string $origin;
        private string $date;
        private string $record;

        public function setOrigin(string $origin): void {
            $this->origin = $origin;
        }

        public function setDate(string $date): void {
            $this->date = $date;
        }

        public function setRecord(string $record): void {
            $this->record = $record;
        }

        public function getOrigin(): string {
            return $this->origin;
        }

        public function getDate(): string {
            return $this->date;
        }

        public function getRecord(): string {
            return $this->record;
        }
    }