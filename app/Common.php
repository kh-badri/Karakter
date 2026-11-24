<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('format_kategori_karakter')) {
    /**
     * Standardisasi dan format label kategori karakter siswa:
     * - ekstrover / ekstrovert -> Terbuka & Ekspresif
     * - introver / introvert   -> Tertutup & Menyendiri
     * - ambiver / ambivert     -> Fleksibel & Seimbang
     */
    function format_kategori_karakter(?string $label): string
    {
        if ($label === null) {
            return '';
        }
        $trimmed = trim($label);
        $lower = strtolower($trimmed);

        if (str_contains($lower, 'ekstrover') || str_contains($lower, 'ekstrovert')) {
            return 'Terbuka & Ekspresif';
        }
        if (str_contains($lower, 'introver') || str_contains($lower, 'introvert')) {
            return 'Tertutup & Menyendiri';
        }
        if (str_contains($lower, 'ambiver') || str_contains($lower, 'ambivert')) {
            return 'Fleksibel & Seimbang';
        }

        return $trimmed;
    }
}

