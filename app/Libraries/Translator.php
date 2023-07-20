<?php

namespace App\Libraries;

use Illuminate\Support\Str;

class Translator
{
    public function getFullKey($class, $function = null, $key = null) {
        $stack = explode('\\', $class);
        if ($function) $stack[] = $function;

        $path = [];
        foreach ($stack as $element) {
            $path[] =  Str::snake($element);
        }

        if ($key) $path[] = $key;

        return implode('.', $path);
    }

    public function translate($key, $replacements = [])
    {
        return $this->discoverTranslation($key, $replacements);
    }

    protected function discoverTranslation($key, $replacements = []) {
        $translated = trans($key, $replacements);
        if ($translated != $key) return $translated;
        if (strpos($key, '.') === false) return;
        $keyInFolder = preg_replace('/\./', '/', $key, 1);
        return $this->discoverTranslation($keyInFolder, $replacements);
    }
}
