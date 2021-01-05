<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    class Attendance extends Model{
        public $timestamps = false;
        protected $table = 'tbl_attendance';
        protected  $primaryKey = 'att_id';

        // column sa table
        protected $fillable = [
        'student_id',
        'event_id',
        ];
    }