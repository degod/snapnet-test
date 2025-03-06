<?php

use App\Enums\TaskStatus;

/**
 * @throws ReflectionException
 */
function enums(string $className, bool $lowerCase = false): array
{
    $reflectedClass = new \ReflectionClass($className);
    $constants = $reflectedClass->getConstants();
    if ($lowerCase) {
        return array_change_key_case($constants, CASE_LOWER);
    }

    return $constants;
}

/**
 * @throws ReflectionException
 */
function get_enum_value(string $className, string $key): string
{
    $constants = enums($className, true);

    return $constants[$key];
}

/**
 * @return string|bool
 */
function get_enum(string $value, string $className)
{
    try {
        $enums = array_flip(enums($className, true));

        return $enums[$value];
    } catch (\Exception) {
        return false;
    }
}

function task_statuses(): array
{
    return enums(TaskStatus::class, true);
}
