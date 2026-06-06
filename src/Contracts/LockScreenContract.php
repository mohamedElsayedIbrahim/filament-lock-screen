<?php

namespace Mohamed\FilamentLockScreen\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

interface LockScreenContract
{
    /**
     * Determine if the current user session is locked.
     */
    public function isLocked(): bool;

    /**
     * Lock the current session.
     */
    public function lock(): void;

    /**
     * Unlock the current session for the authenticated user.
     */
    public function unlock(string $password): bool;

    /**
     * Check if the given credentials are valid.
     */
    public function validateCredentials(Authenticatable $user, string $password): bool;

    /**
     * Get the last recorded user activity timestamp.
     */
    public function getLastActivity(): ?\DateTimeInterface;

    /**
     * Update the last activity timestamp.
     */
    public function updateLastActivity(): void;

    /**
     * Determine if the session has expired based on timeout config.
     */
    public function hasTimedOut(): bool;

    /**
     * Get lock screen route URL.
     */
    public function getLockScreenUrl(): string;
}