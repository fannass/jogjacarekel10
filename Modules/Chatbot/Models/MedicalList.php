<?php

namespace Modules\Chatbot\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalList extends Model
{
    protected $table = 'medical_lists';
    protected $fillable = ['name'];
} 