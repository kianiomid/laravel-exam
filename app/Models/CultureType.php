<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultureType extends Model
{
    use HasFactory;

    const TABLE = "culture_types";

    protected $table = self::TABLE;

    protected $fillable = ["name", "descriptor", "direction"];

    const FA = 'fa';
    const EN = 'en';
}
