<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractVendor extends Model
{
    use HasFactory;

    protected $table = "contract_vendor";

    protected $fillable = ['id', 'contract_id', 'status_id', 'vendor_id', 'number', 'director', 'address', 'phone', 'filename', 'created_at', 'updated_at'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function review()
    {
        return $this->belongsTo(ReviewLegal::class, 'review_id');
    }
}
