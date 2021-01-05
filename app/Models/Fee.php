<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    class Fee extends Model{
        
        public $timestamps = false;
        protected $table = 'tbl_fee';
        protected  $primaryKey = 'fee_id';
        // column sa table
        protected $fillable = [
        'amount','student_id'
        ];
    }