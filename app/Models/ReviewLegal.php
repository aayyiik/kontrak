<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewLegal extends Model
{
    use HasFactory;
    protected $table = "review_legals";

    protected $fillable = ['id', 'contract_id', 'user_id', 'status_id', 'vendor_id', 'review_contract', 'created_at', 'updated_at'];

    public function contract()
    {
        return $this->hasOne(Contract::class, 'contract_id');
    }
}
