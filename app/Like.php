<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {
    /**
     * Like morphs to models in likeable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable(){
    	// morphTo($name = likeable, $type = likeable_type, $id = likeable_id)
    	// requires likeable_type and likeable_id fields on $this->table
    	return $this->morphTo();
    } // end method

    /**
     * Like belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    } // end method
}
