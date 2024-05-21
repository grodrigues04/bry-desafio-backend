<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $hidden = ['pivot'];
    protected $table = 'companies';
    protected $fillable = [
    'name',
    'cnpj',
    'address',
    ];  
    use HasFactory;
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_company', 'company_id', 'employee_id',);
    }
}
