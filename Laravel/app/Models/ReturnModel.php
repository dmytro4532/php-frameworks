<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    use HasFactory;

    protected $table = 'return_models';

    protected $fillable = ['loan_id', 'return_date'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
