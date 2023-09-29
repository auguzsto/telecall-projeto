<?php

namespace App\models;
use App\controllers\ModuleController;

    class AccessControl {

        private Module $module;
        private string $permission_create;
        private string $permission_execute;
        private string $permission_read;
        private string $permission_update;
        private string $permission_delete;

        public static function fromMap(array $map): AccessControl {
            $access_control = new self();
            $access_control->setModule(Module::fromMap(ModuleController::findById($map['module_id'])));
            $access_control->setPermission_create($map['permission_create']);
            $access_control->setPermission_delete($map['permission_delete']);
            $access_control->setPermission_execute($map['permission_execute']);
            $access_control->setPermission_read($map['permission_read']);
            $access_control->setPermission_update($map['permission_update']);

            return $access_control;
        }
        public function getModule(): Module {
            return $this->module;
        }

        public function getPermission_create(): string {
            return $this->permission_create;
        }

        public function getPermission_execute(): string {
            return $this->permission_execute;
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

        public function setModule(Module $module): void {
            $this->module = $module;
        }

        public function setPermission_create($permission_create): void {
            $this->permission_create = $permission_create;
        }

        public function setPermission_execute($permission_execute): void {
            $this->permission_execute = $permission_execute;
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