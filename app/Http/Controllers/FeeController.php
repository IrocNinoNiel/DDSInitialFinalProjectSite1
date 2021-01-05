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
            $fee = Fee::all();
            return $this->successResponse($fee);
        }

        public function getFee($fee_id){
            $fee = Fee::find($fee_id);
            if($fee == null) return $this->errorResponse('No Such Fee in the database',404);
            return $this->successResponse($fee);
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