<?php
class Database {
    public static function connect() {
        #return new mysqli('localhost', 'root', '', 'citasmedicas');
        return new mysqli('db', 'usuario', 'clave', 'citasmedicas');

    }
}