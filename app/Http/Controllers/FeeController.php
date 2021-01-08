<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Fee;
    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;

use function PHPUnit\Framework\isEmpty;

Class FeeController extends Controller {   
        use ApiResponser;
        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }

        public function getFees(){
            $fee = Fee::select('tbl_fee.*')
            ->leftJoin('tbl_student','tbl_student.student_id','=','tbl_fee.student_id')
            ->select('tbl_fee.fee_id','tbl_student.student_name','tbl_student.student_year','tbl_student.student_gender','tbl_student.student_contact','tbl_student.student_email')->get();

            return $this->successResponse($fee);
        }

        public function getFee($fee_id){
            $fee = Fee::find($fee_id);
            if($fee == null) return $this->errorResponse('No Such Fee in the database',404);

            echo $fee_id;
            
            $feeStudent = Fee::where('fee_id',$fee_id)
            ->leftJoin('tbl_student','tbl_student.student_id','=','tbl_fee.student_id')
            ->select('tbl_fee.fee_id','tbl_student.student_name','tbl_student.student_year','tbl_student.student_gender','tbl_student.student_contact','tbl_student.student_email')->first();

            return $this->successResponse($feeStudent);
        }

        public function findIfStudentPay($student_id){
            $fee = Fee::where('student_id',$student_id)->get();
            return $this->successResponse($fee);
        }

        public function addFee(Request $request){

            $rules = [
                'amount' => 'required|numeric|min:1',
                'student_id' => 'required|numeric|max:20'
            ];

            $this->validate($request, $rules);

            $student = Fee::where('student_id',$request->student_id)->get();
            if(!$student->isEmpty()) return $this->errorResponse('Student Already Paid',404);

            $fee = new Fee;

            $fee->amount = $request->amount;
            $fee->student_id = $request->student_id;

            $fee->save();

            return $this->successResponse($fee);
        
        }

        public function updateFee(Request $request,$fee_id){

            $rules = [
                'amount' => 'required|numeric|min:0',
                'student_id' => 'required|numeric|max:20'
            ];

            $this->validate($request, $rules);

            $fee = Fee::find($fee_id);
            if($fee == null) return $this->errorResponse('No Such Fee in the database',404);

            $fee->amount = $request->amount;
            $fee->student_id = $request->student_id;

            $fee->save();

            return $this->successResponse($fee);
        }

        public function deleteStudentFee($student_id){
            $fee = Fee::where('student_id',$student_id)->get();
                          Fee::where('student_id',$student_id)->delete();
            return $this->successResponse('Students Fee Succesfully Deleted');
        }
    }