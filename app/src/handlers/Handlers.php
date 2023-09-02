<?php
namespace App\handlers;
use Exception;

    class Handlers extends Exception {
        public static function success(string $title, string $message) {
            echo "
                <script>
                    Swal.fire(
                        '$title',
                        '$message',
                        'success'
                    )
                </script>
            ";
        }

        public static function error(string $title, string $message) {
            echo "
                <script>
                    Swal.fire(
                        '$title',
                        '$message',
                        'error'
                    )
                </script>
            ";
        }

        public static function warning(string $title, string $message) {
            echo "
                <script>
                    Swal.fire(
                        '$title',
                        '$message',
                        'warning'
                    )
                </script>
            ";
        }
    }