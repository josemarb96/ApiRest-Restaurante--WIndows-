<?php

class DatabaseModel
{
    private $_connection;
    private static $_instance;

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $config = parse_ini_file('Config/config.ini');

        $this->_connection = new mysqli($config['host'], $config['username'],$config['password'], $config['dbname']);

        if ($this->_connection->connect_error)
        {
            trigger_error("Failed to connect to MySQL: " . $this->_connection->connect_error,
                E_USER_ERROR);
        }
    }

    public function __clone()
    {
        trigger_error("Cloning of " . get_class($this) . " not allowed: ", E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error("Deserialization of " . get_class($this) . " not allowed: ", E_USER_ERROR);
    }

    public function getConnection()
    {
        return $this->_connection;
    }


    public function closeConnection()
    {
        $this->_connection->close();
        self::$_instance=null;
    }

    public function reconnect(){
        $this->_connection->close();
        self::$_instance=null;
        return self::getInstance()->getConnection();
    }
}