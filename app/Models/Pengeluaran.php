<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'qty', 'description'];

    public function getDateStringAttribute()
    {
        return $this->date_string = date("d/m/Y", strtotime($this->created_at));
    }

    public function getQtyStringAttribute()
    {
        return $this->qty_string = number_format($this->qty);
    }
}
