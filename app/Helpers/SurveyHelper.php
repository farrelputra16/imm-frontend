<?php

if (!function_exists('getRuleValue')) {
    function getRuleValue($rules, $key)
    {
        foreach ($rules as $rule) {
            if (strpos($rule, $key) !== false) {
                return explode(':', $rule)[1] ?? null;
            }
        }
        return null;
    }
}
