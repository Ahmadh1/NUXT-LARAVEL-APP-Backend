<?php 

namespace App\Traits;

trait Orderable{
	public function scopeLatestFirst($query) {
		return $query->orderBy('created_at', 'desc');
	} // end method

	public function scopeOldestFirst($query) {
		return $query->orderBy('created_at', 'asc');
	} // end method

} // end orderable