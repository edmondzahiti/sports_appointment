<?php
use Illuminate\Support\Str;


if (!function_exists('is_active')) {
    /**
     * Check if this route name is active.
     *
     * @param  string $name
     * @return string
     */
    function is_active(string $name)
    {
        if (Str::contains($name, '*') == 1) {
            return (request()->is($name) == true) ? 'active' : '';
        }

        if (request()->route()->getName() === $name) {
            return 'active';
        }

        // $parts = request()->segments();
        // // if (Str::is($name, implode("/", $parts))) {
        // if (Str::containsAll($name, $parts)) {
        //     return 'active';
        // }

        return '';
    }
}




