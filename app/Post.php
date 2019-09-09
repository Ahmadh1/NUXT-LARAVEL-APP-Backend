<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $fillable = ['body'];

   /**
    * Post belongs to User.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user() {
   	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
   	return $this->belongsTo(User::class);
   } // end user


    /**
     * Post belongs to Topic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic() {
    	// belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
    	return $this->belongsTo(Topic::class);
    } // end topic

    /**
     * Post morphs many Like.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes() {
      // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
      return $this->morphMany(Like::class, 'likeable');
    } // end likes
}
