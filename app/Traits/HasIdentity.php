<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasIdentity
{
    protected static ?string $classKey = null;

    protected static ?string $classDisplayName = null;

    public static function getClassKey(): string
    {
        return static::$classKey ??= Str::snake(class_basename(static::class));
    }

    public static function getClassDisplayName(): string
    {
        return static::$classDisplayName ??= Str::headline(class_basename(static::class));
    }
}
