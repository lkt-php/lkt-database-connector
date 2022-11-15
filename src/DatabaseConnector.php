<?php

namespace Lkt\DatabaseConnectors;

use Lkt\Factory\Schemas\Schema;
use Lkt\QueryBuilding\Query;

abstract class DatabaseConnector
{
    protected $name;
    protected $host = '';
    protected $user = '';
    protected $password = '';
    protected $database = '';
    protected $port = 0;
    protected $charset = '';
    protected $connection = null;
    protected $ignoreCache = false;
    protected $forceRefresh = false;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return static
     */
    public static function define(string $name): self
    {
        return new static($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string $charset
     * @return $this
     */
    public function setCharset(string $charset): self
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @param string $database
     * @return $this
     */
    public function setDatabase(string $database): self
    {
        $this->database = $database;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @param string $user
     * @return $this
     */
    public function setUser(string $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return $this
     */
    public function forceRefreshNextQuery()
    {
        $this->forceRefresh = true;
        return $this;
    }

    /**
     * @return $this
     */
    protected function forceRefreshFinished()
    {
        $this->forceRefresh = false;
        return $this;
    }

    abstract public function connect(): self;
    abstract public function disconnect(): self;
    abstract public function query(string $query, array $replacements = []):? array;
    abstract public function extractSchemaColumns(Schema $schema): array;
    abstract public function getLastInsertedId(): int;
    abstract public function makeUpdateParams(array $params = []) :string;
    abstract public function getQuery(Query $builder, string $type, string $countableField): string;
}