<?php

use Tresorkasenda\Notifications\Toast;

if (!function_exists('toast')) {
    /**
     * Helper function for displaying toast notifications.
     *
     * @param string|null $message
     * @param string $type success|error|warning|info
     * @param int $duration Duration in milliseconds
     * @param string $position Position (top-right, top-left, bottom-right, bottom-left, top-center, bottom-center)
     * @return Toast|void
     */
    function toast(?string $message = null, string $type = 'info', int $duration = 3000, string $position = 'top-right')
    {
        if ($message === null) {
            return new Toast();
        }

        Toast::custom($type, $message, $duration, $position);
    }
}

if (!function_exists('toast_success')) {
    /**
     * Display a success toast notification.
     *
     * @param string $message
     * @param int $duration
     * @param string $position
     * @return void
     */
    function toast_success(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        Toast::success($message, $duration, $position);
    }
}

if (!function_exists('toast_error')) {
    /**
     * Display an error toast notification.
     *
     * @param string $message
     * @param int $duration
     * @param string $position
     * @return void
     */
    function toast_error(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        Toast::error($message, $duration, $position);
    }
}

if (!function_exists('toast_warning')) {
    /**
     * Display a warning toast notification.
     *
     * @param string $message
     * @param int $duration
     * @param string $position
     * @return void
     */
    function toast_warning(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        Toast::warning($message, $duration, $position);
    }
}

if (!function_exists('toast_info')) {
    /**
     * Display an info toast notification.
     *
     * @param string $message
     * @param int $duration
     * @param string $position
     * @return void
     */
    function toast_info(string $message, int $duration = 3000, string $position = 'top-right'): void
    {
        Toast::info($message, $duration, $position);
    }
}
