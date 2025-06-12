<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class YearAcademicFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Pertama, pastikan format umum YYYY/YYYY dengan regex
        if (!preg_match('/^\d{4}\/\d{4}$/', $value)) {
            $fail('Format :attribute tidak valid. Gunakan format YYYY/YYYY (Contoh: 2023/2024 atau 2019/2021).');
            return;
        }

        $parts = explode('/', $value);
        $year1 = (int) $parts[0];
        $year2 = (int) $parts[1];

        // *** LOGIKA YANG DIUBAH: Pastikan tahun kedua lebih besar dari tahun pertama ***
        if ($year2 <= $year1) {
            $fail('Tahun kedua di :attribute harus lebih besar dari tahun pertama.');
            return;
        }

        // Opsional: Batasi rentang tahun yang masuk akal
        $currentYear = (int) date('Y');
        // Misalnya, tahun awal tidak terlalu lampau (contoh: 20 tahun ke belakang)
        // Dan tahun kedua tidak terlalu jauh di masa depan (contoh: 5 tahun ke depan dari tahun sekarang)
        if ($year1 < ($currentYear - 20) || $year2 > ($currentYear + 5)) {
            $fail('Rentang tahun di :attribute tidak valid. Pastikan tahun masuk akal.');
            return;
        }

        // Opsional: Batasi maksimum rentang tahun (misalnya tidak boleh lebih dari 3 tahun)
        if (($year2 - $year1) > 3) {
            $fail('Rentang tahun ajaran di :attribute tidak boleh lebih dari 3 tahun.');
            return;
        }
    }
}
