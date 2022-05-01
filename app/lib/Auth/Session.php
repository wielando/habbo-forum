<?php

namespace app\lib\Auth;

abstract class Session
{
    abstract public function createSessions(array $sessionValues): bool;
    abstract public function updateSessions(array $sessionArray): bool;

    private array $keys;

    protected function __construct(array $keys)
    {
        $this->setKeys($keys);
    }

    private function setKeys(array $keys): void
    {
        foreach ($keys as $index) {
            $this->keys[$index] = '';
        }
    }

    protected function create(array $sessionValues): bool
    {
        foreach ($sessionValues as $key => $value) {
            if (!$this->isSessionAvailable($key)) {
                continue;
            }

            if ($this->isSessionAlreadyCreated($key)) {
                continue;
            }

            $_SESSION[$key] = $value;
        }

        return true;
    }

    protected function update(array $sessionValues): bool
    {
        foreach ($sessionValues as $key => $value) {
            if (!$this->isSessionAvailable($key)) {
                continue;
            }

            if (!$this->isSessionAlreadyCreated($key)) {
                continue;
            }

            $_SESSION[$key] = $value;
        }

        return true;
    }

    protected function destroy() {
        session_destroy();
    }

    private function isSessionAlreadyCreated(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    private function isSessionAvailable(string $key): bool
    {
        foreach ($this->keys as $index => $value) {
            if ($key !== $index) {
                continue;
            }

            return true;
        }

        return false;
    }
}