<?php

declare(strict_types=1);

namespace Tresorkasenda\Notifications;

use Livewire\Component;

/**
 * Toast Notification System
 *
 * Provides a simple interface for displaying toast notifications.
 *
 * @package Tresorkasenda\Notifications
 */
class Toast
{
    /**
     * Show a success toast notification.
     *
     * @param string $message
     * @param int $duration Duration in milliseconds
     * @param string $position Position (top-right, top-left, bottom-right, bottom-left, top-center, bottom-center)
     * @return void
     */
    public static function success(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        self::dispatch('toast', [
            'type' => 'success',
            'message' => $message,
            'duration' => $duration,
            'position' => $position,
        ]);
    }

    /**
     * Show an error toast notification.
     *
     * @param string $message
     * @param int $duration Duration in milliseconds
     * @param string $position
     * @return void
     */
    public static function error(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        self::dispatch('toast', [
            'type' => 'error',
            'message' => $message,
            'duration' => $duration,
            'position' => $position,
        ]);
    }

    /**
     * Show a warning toast notification.
     *
     * @param string $message
     * @param int $duration Duration in milliseconds
     * @param string $position
     * @return void
     */
    public static function warning(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        self::dispatch('toast', [
            'type' => 'warning',
            'message' => $message,
            'duration' => $duration,
            'position' => $position,
        ]);
    }

    /**
     * Show an info toast notification.
     *
     * @param string $message
     * @param int $duration Duration in milliseconds
     * @param string $position
     * @return void
     */
    public static function info(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        self::dispatch('toast', [
            'type' => 'info',
            'message' => $message,
            'duration' => $duration,
            'position' => $position,
        ]);
    }

    /**
     * Show a custom toast notification.
     *
     * @param string $type
     * @param string $message
     * @param int $duration
     * @param string $position
     * @return void
     */
    public static function custom(string $type, string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        self::dispatch('toast', [
            'type' => $type,
            'message' => $message,
            'duration' => $duration,
            'position' => $position,
        ]);
    }

    /**
     * Dispatch a browser event for toast notification.
     *
     * @param string $event
     * @param array $data
     * @return void
     */
    protected static function dispatch(string $event, array $data): void
    {
        // Dispatch as a browser event
        if (app()->has('livewire')) {
            Component::dispatch($event, $data);
        }
    }
}
