<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = "contracts";

    protected $fillable = ['id', 'user_detail_id', 'template_id', 'name', 'created_at', 'updated_at'];

    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class)->withPivot('number', 'director', 'address', 'phone', 'status_id');
    }
}
