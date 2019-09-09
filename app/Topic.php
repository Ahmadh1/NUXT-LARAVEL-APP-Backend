<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

	use Orderable;

    protected $fillable = ['title'];

    /**
     * Topic belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    } // end user

    /**
     * Topic has many Posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()  {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = topic_id, localKey = id)
    	return $this->hasMany(Post::class);
    } // end posts
}
