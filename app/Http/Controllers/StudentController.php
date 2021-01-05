<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Student;
    use  App\Models\User;
    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;

    Class StudentController extends Controller {   
        use ApiResponser;
        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }
        
        public function getStudents(){

            $student = Student::all();
            return $this->successResponse($student);

        }

        public function getStudent($student_id){
            $student = Student::find($student_id);
            if($student == null) return $this->errorResponse('No Such Student in the database',404);
            return $this->successResponse($student);
        }

        public function addStudent(Request $request){   
            $rules = [
                'student_name' => 'required|max:50',
                'student_year' => 'required|max:20',
                'student_gender' => 'required|in:Male,Female',
                'student_contact' => 'required|max:11',
                'student_email' => 'required|max:20',
                'student_course' => 'required|numeric|max:20',
                'student_org' => 'required|numeric|max:20',
            ];

            $this->validate($request, $rules);

            $student = new Student;

            $student->student_name = $request->student_name;
            $student->student_year = $request->student_year;
            $student->student_gender = $request->student_gender;
            $student->student_contact = $request->student_contact;
            $student->student_email = $request->student_email;
            $student->student_course  = $request->student_course;
            $student->student_org = $request->student_org;
            $student->security_key = 'h5h7ecDMZPoTog4x6rrHyclkdoW2laA1';

            $student->save();
            
            return $this->successResponse($student);
        }

        public function updateStudent(Request $request,$student_id){
            $rules = [
                'student_name' => 'required|max:50',
                'student_year' => 'required|max:20',
                'student_gender' => 'required|max:20',
                'student_contact' => 'required|max:20',
                'student_email' => 'required|max:20',
                'student_course' => 'required|numeric|max:20',
                'student_org' => 'required|numeric|max:20',
            ];

            $this->validate($request, $rules);
            // validate if Jobid is found in the table tbluserjob
            //  $userjob = UserJob::findOrFail($request->jobid);
            // echo $userjob;

            $student = Student::find($student_id);

            if($student == null) return $this->errorResponse('No Such Student in the database',404);

            $student->student_name = $request->student_name;
            $student->student_year = $request->student_year;
            $student->student_gender = $request->student_gender;
            $student->student_contact = $request->student_contact;
            $student->student_email = $request->student_email;
            $student->student_course  = $request->student_course;
            $student->student_org = $request->student_org;
            $student->security_key = 'h5h7ecDMZPoTog4x6rrHyclkdoW2laA1';

            $student->save();
            return $this->successResponse($student);
        }

        public function deleteStudent($student_id){
            $student = Student::find($student_id);

            if($student == null) return $this->errorResponse('No Student Found in the Database',404);

            $student->delete();

            return $this->successResponse($student);
        }
    }