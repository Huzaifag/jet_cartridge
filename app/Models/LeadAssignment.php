<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadAssignment extends Model
{
    protected $table = 'lead_assignments';
    protected $fillable = [
        'lead_id',
        'employee_id',
        'priority',
        'notes',
        'status',
    ];

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
