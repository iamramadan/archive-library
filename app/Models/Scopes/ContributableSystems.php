<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ContributableSystems implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!Auth::check()) {
            // If the user is not authenticated, return nothing
            $builder->whereRaw('0 = 1');
            return;
        }

        $user = Auth::user();

        $systemIds = $user->Ticket()
            ->where('type', 'contributor')
            ->pluck('system')
            ->toArray();

        $builder->where(function ($query) use ($user, $systemIds) {
            $query->where('creator', $user->id)
                  ->orWhereIn('id', $systemIds);
        });
    }
}
