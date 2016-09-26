<?php

    namespace Jagger\Model;

    class User extends \Illuminate\Database\Eloquent\Model
    {

        protected $fillable = array('password', 'email');
        public $timestamps  = false;

    }

?>