<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    class Event extends Model{
        public $timestamps = false;
        protected $table = 'tbl_event';
        protected  $primaryKey = 'event_id';

        // column sa table
        protected $fillable = [
        'event_name',
        ];
    }