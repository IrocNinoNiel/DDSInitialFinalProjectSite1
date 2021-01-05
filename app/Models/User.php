<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    class User extends Model{
        
        public $timestamps = false;
        protected $table = 'tbl_user';
        protected  $primaryKey = 'user_id';
        // column sa table
        protected $fillable = [
        'user_name', 'user_pass','student_id','teacher_id','role_id'
        ];

        protected $hidden = [
            'password',
        ];
    }