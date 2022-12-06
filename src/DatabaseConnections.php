<?php

namespace Lkt\DatabaseConnectors;

class DatabaseConnections
{
    /** @var DatabaseConnector[] */
    protected static $connectors = [];
    public static $defaultConnector = 'default';

    public static function setDefaultConnector(string $name): void
    {
        static::$defaultConnector = $name;
    }

    public static function set(DatabaseConnector $connector)
    {
        if (isset(static::$connectors[$connector->getName()])) {
            throw new \Exception("Invalid Connector Name: Connector name already in use ('{$connector->getName()}')");
        }
        static::$connectors[$connector->getName()] = $connector;
    }

    public static function get(string $name): DatabaseConnector
    {
        if (!isset(static::$connectors[$name])) {
            throw new \Exception("Connector '{$name}' doesn't exists");
        }
        return static::$connectors[$name];
    }

    public static function getDefaultConnector(): DatabaseConnector
    {
        $name = static::$defaultConnector;
        if (!isset(static::$connectors[$name])) {
            throw new \Exception("Connector '{$name}' doesn't exists");
        }
        return static::$connectors[$name];
    }

    /**
     * @return DatabaseConnector[]
     */
    public static function getAllConnectors(): array
    {
        return static::$connectors;
    }
}