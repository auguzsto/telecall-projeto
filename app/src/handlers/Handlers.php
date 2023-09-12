<?php
namespace App\handlers;
use App\services\Logger;
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

        public static function error(string $title, string $message, string $getMessageException) {
            echo "
                <script>
                    Swal.fire(
                        '$title',
                        '$message',
                        'error'
                    )
                </script>
            ";

            Logger::createInFolderLog($_SERVER['PATH_INFO'], $getMessageException);
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