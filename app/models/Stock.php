
<?php


class Stock extends Eloquent {

public function users() {
        # Books belong to many Tags     
        return $this->belongsToMany('User');
    }

public $timestamps = false; 
}