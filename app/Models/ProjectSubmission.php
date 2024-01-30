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
        'professor',
        'proofreader',
        'attachments',
        'attachments_names',
        'team',
        'academic_year',
        'term',
    ];
    protected $casts = [
        'attachments' => 'array',
        'attachments_names' => 'array',
    ];
    
    
}
