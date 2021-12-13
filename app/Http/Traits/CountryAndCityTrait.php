<?php

namespace App\Http\Traits;
use App\Models\Student;

trait CountryAndCityTrait {
    public function scopeCreatedBetween($query, $createdAfter, $createdBefore) {
        if ($createdAfter == null && $createdBefore == null) {
            return $query;
        } elseif ($createdAfter == null && $createdBefore != null) {
            return $query->where('created_at', '<', $createdBefore);
        } elseif ($createdAfter == null && $createdBefore != null) {
            return $query->where('created_at', '>', $createdAfter);
        } else {
            return $query->where('created_at', '>', $createdAfter)->
            where('created_at', '<', $createdBefore);
        }
    }

    public function scopeSearch($query, $search) {
        if($search != null) {
            return $query->where('name', 'like', "%{$search}%");
        } else {
            return $query;
        }
    }

    public function scopeOrder($query, $order) {
        if($order == "asc") {
            return $query->orderBy('name', "asc");
        } elseif($order == "desc") {
            return $query->orderBy('name', "desc");
        } else {
            return $query;
        }
    }
}
