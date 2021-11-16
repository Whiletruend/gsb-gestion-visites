<?php
    //      
    // Class name: Database 
    //                   

    // Namespaces & Uses
    namespace App\model;
    use PDO;

    // Class
    class Database {
        # Variables
        private static $conn_DB = null;
        private static $host_DB = '127.0.0.1';
        private static $name_DB = 'gsb_gestion_visites';
        private static $user_DB = 'root';
        private static $pass_DB = '';

        # Functions
        protected static function getPDO() : object {
            if(is_null(self::$conn_DB)) {
                $connectPDO = new PDO('mysql:host=' . self::$host_DB . ';dbname=' . self::$name_DB . ';charset=utf8', self::$user_DB, self::$pass_DB);
                $connectPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$conn_DB = $connectPDO;
            }

            return self::$conn_DB;
        }

        protected static function query($statement) : object {
            $stat = self::getPDO()->query($statement);

            return $stat;
        }

        protected static function prepare($statement, $attributes) : array {
            $stat = self::getPDO()->prepare($statement);
            $stat->execute($attributes);

            return $stat->fetchAll();
        }

        protected static function prepareFetch($statement, $attributes) : object {
            $stat = self::getPDO()->prepare($statement);
            $stat->execute($attributes);

            return $stat->fetch();
        }

        protected static function request($statement, $attributes) : void {
            $stat = self::getPDO()->prepare($statement);

            $stat->execute($attributes);
        }
    }
?>