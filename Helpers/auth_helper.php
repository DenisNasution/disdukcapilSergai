<?php

if (!function_exists('is_superadmin')) {
    /**
     * Check if the current logged-in user is a superadmin
     */
    function is_superadmin(): bool
    {
        return session()->get('admin_role') === 'superadmin';
    }
}

if (!function_exists('is_admin')) {
    /**
     * Check if the current logged-in user is an admin (any role)
     */
    function is_admin(): bool
    {
        return session()->get('is_admin_logged_in') === true;
    }
}

if (!function_exists('current_admin_role')) {
    function current_admin_role(): string
    {
        return session()->get('admin_role') ?? 'guest';
    }
}