<?php
namespace App\handlers;

    class Handlers {
        public static function sucess(string $title, string $message) {
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
    }