<?php

namespace App\models;

    class GroupsPermissionsAcl {

        private int $id;
        private string $description;
        private string $permission_create;
        private string $permission_read;
        private string $permission_update;
        private string $permission_delete;

        private function __construct(int $id, string $description, string $permission_create, string $permission_read, string $permission_update, string $permission_delete) {
            $this->setId($id);
            $this->setDescription($description);
            $this->setPermission_create($permission_create);
            $this->setPermission_read($permission_read);
            $this->setPermission_update($permission_update);
            $this->setPermission_delete($permission_delete);
        }

        public static function fromMap(array $map): GroupsPermissionsAcl {
            $groupsPermissionsAcl = new self(
                $map['id'], 
                $map['description'],
                $map['permission_create'],
                $map['permission_read'],
                $map['permission_update'],
                $map['permission_delete'],
            );

            return $groupsPermissionsAcl;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getDescrition(): string {
            return $this->description;
        }

        public function getPermission_create(): string {
            return $this->permission_create;
        }

        public function getPermission_read(): string {
            return $this->permission_read;
        }

        public function getPermission_update(): string {
            return $this->permission_update;
        }

        public function getPermission_delete(): string {
            return $this->permission_delete;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setDescription(string $description): void {
            $this->description = $description;
        }

        public function setPermission_create($permission_create): void {
            $this->permission_create = $permission_create;
        }

        public function setPermission_read($permission_read): void {
            $this->permission_read = $permission_read;
        }

        public function setPermission_update($permission_update): void {
            $this->permission_update = $permission_update;
        }

        public function setPermission_delete($permission_delete): void {
            $this->permission_delete = $permission_delete;
        }
    }