<?php

class Task extends Eloquent {
    
    // Model the Many-to-one relationship between users and tasks
    public function user() {
        // A task belongs to a user
        return $this->belongsTo('User');
    }

}
