<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EightyNine\Approvals\Models\ApprovableModel;

class ProjectSubmission extends ApprovableModel
{
    
    use HasFactory;
    protected $fillable = [
        'title',
        'abstract',
        'categories',
        'subject',
    ];
    
}
