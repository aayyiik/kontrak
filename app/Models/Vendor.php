<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = "vendors";

    protected $fillable = ['id', 'user_detail_id', 'vendor', 'no_sap', 'no_eproc', 'phone', 'address', 'created_at', 'updated_at'];

    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }

    public function contracts()
    {
        return $this->belongsToMany(Contract::class)->withPivot('number', 'director', 'address', 'phone', 'status_id');
    }
}
