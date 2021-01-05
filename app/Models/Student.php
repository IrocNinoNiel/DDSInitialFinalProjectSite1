<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    class Student extends Model{
        
        public $timestamps = false;
        protected $table = 'tbl_student';
        protected  $primaryKey = 'student_id';

        // column sa table
        protected $fillable = [
        'student_name',
        'student_year',
        'student_gender',
        'student_contact',
        'student_email',
        'student_course',
        'student_org',
        ];
    }