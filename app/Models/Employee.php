<?php
#Model: control and interact with BD
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $hidden = ['pivot'];
    protected $table = 'employees';
    protected $fillable = [
    'name',
    'cpf',
    'email',
    'login',
    'password',
    'address',
    ];  
    use HasFactory;

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'employee_company', 'employee_id', 'company_id',);
    }
}