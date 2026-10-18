<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsvImport extends Model
{
    protected $fillable = [
        'file_name',
        'last_processed_row'
    ];
}
