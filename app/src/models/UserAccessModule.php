<?php

namespace App\models;

    class UserAccessModule {
        
        private User $user;
        private AccessControl $accessControl;
        private Module $module;

        public function getUser(): User {
            return $this->user;
        }

        public function getAccessControl(): AccessControl {
            return $this->accessControl;
        }

        public function getModule(): Module {
            return $this->module;
        }

        public function setUser(User $user): void {
            $this->user = $user;
        }

        public function setAccessControl(AccessControl $accessControl): void {
            $this->accessControl = $accessControl;
        }

        public function setModule(Module $module): void {
            $this->module = $module;
        }
    }