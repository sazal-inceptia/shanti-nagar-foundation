<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'receipt_number',
        'donor_id',
        'project_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_id',
        'donation_date',
        'purpose',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'donation_date' => 'date',
    ];

    /**
     * Get the donor who made this donation.
     */
    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    /**
     * Get the project associated with this donation (if specified).
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get donation amount in words (Bangladeshi Taka).
     */
    public function getAmountInWordsAttribute(): string
    {
        return self::convertNumberToWords((int) round((float) $this->amount));
    }

    /**
     * Convert numeric amount to words in Bangladeshi Taka style.
     */
    public static function convertNumberToWords(int $number): string
    {
        $dictionary = [
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
        ];

        if ($number === 0) {
            return 'Zero Taka Only';
        }

        if ($number < 0) {
            return 'Negative '.self::convertNumberToWords(abs($number));
        }

        $crore = (int) ($number / 10000000);
        $number %= 10000000;

        $lakh = (int) ($number / 100000);
        $number %= 100000;

        $thousand = (int) ($number / 1000);
        $number %= 1000;

        $hundred = (int) ($number / 100);
        $number %= 100;

        $words = [];

        if ($crore > 0) {
            $words[] = self::convertTwoDigits($crore, $dictionary).' Crore';
        }
        if ($lakh > 0) {
            $words[] = self::convertTwoDigits($lakh, $dictionary).' Lakh';
        }
        if ($thousand > 0) {
            $words[] = self::convertTwoDigits($thousand, $dictionary).' Thousand';
        }
        if ($hundred > 0) {
            $words[] = $dictionary[$hundred].' Hundred';
        }
        if ($number > 0) {
            $words[] = self::convertTwoDigits($number, $dictionary);
        }

        return implode(' ', $words).' Taka Only';
    }

    private static function convertTwoDigits(int $num, array $dictionary): string
    {
        if ($num < 20) {
            return $dictionary[$num] ?? '';
        }

        $tens = ((int) ($num / 10)) * 10;
        $units = $num % 10;

        return $dictionary[$tens].($units > 0 ? ' '.$dictionary[$units] : '');
    }
}
