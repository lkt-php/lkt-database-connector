<?php

namespace Lkt\DatabaseConnectors;

class DatabaseConnections
{
    /** @var DatabaseConnector[] */
    protected static $connectors = [];

    /**
     * @param DatabaseConnector $connector
     * @return void
     * @throws \Exception
     */
    public static function set(DatabaseConnector $connector)
    {
        if (isset(static::$connectors[$connector->getName()])) {
            throw new \Exception("Invalid Connector Name: Connector name already in use ('{$connector->getName()}')");
        }
        static::$connectors[$connector->getName()] = $connector;
    }

    /**
     * @param string $name
     * @return DatabaseConnector
     * @throws \Exception
     */
    public static function get(string $name): DatabaseConnector
    {
        if (!isset(static::$connectors[$name])) {
            throw new \Exception("Connector '{$name}' doesn't exists");
        }
        return static::$connectors[$name];
    }
}