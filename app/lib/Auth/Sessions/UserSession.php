<?php

namespace app\lib\Auth\Sessions;


use app\lib\Auth\Session;

/**
 * User Session ist abhängig von Session. User Session kann nicht ohne Session existieren, Session kann
 * ohne User Session existieren.
 *
 * Um User Session zu verwenden, ist eine Verwendung der Session Funktionen NOTWENDIG.
 */
class UserSession extends Session
{
    public string $username;
    private int $userId;

    private array $keys = ['username', 'id'];

    public function __construct()
    {
        parent::__construct($this->keys);
        return $this;
    }


    public function createSessions(array $sessionValues): bool
    {
        return $this->create($sessionValues);
    }

    public function updateSessions(array $sessionArray): bool
    {
        return $this->update($sessionArray);
    }
}