<?php
#Model: control and interact with BD
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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
}
