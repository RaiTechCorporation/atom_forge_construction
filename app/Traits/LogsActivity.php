<?php

namespace App\Traits;

use App\Models\RoleAuditLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected function logActivity($action, $model, $oldValues = null, $newValues = null)
    {
        RoleAuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => class_basename($model),
            'model_id' => $model->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
