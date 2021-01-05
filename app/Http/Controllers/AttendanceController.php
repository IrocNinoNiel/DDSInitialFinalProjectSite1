<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Attendance;
    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;

    Class AttendanceController extends Controller {   
        use ApiResponser;
        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }
        
        public function getAttendances(){
            $attendance = Attendance::all();
            return $this->successResponse($attendance);
        }

        public function getEventAttendance($event_id){
            $attendance = Attendance::where('event_id',$event_id)->get();
            return $this->successResponse($attendance);
        }

        public function getStudentAttendance($student_id){
            $attendance = Attendance::where('student_id',$student_id)->get();
            return $this->successResponse($attendance);
        }

        public function addAttendance(Request $request){
            $rules = [
                'student_id' => 'required|numeric',
                'event_id' => 'required|numeric',
            ];

            $this->validate($request, $rules);

            $attendance = new Attendance;

            $attendance->student_id = $request->student_id;
            $attendance->event_id = $request->event_id;

            $attendance->save();

            return $this->successResponse($attendance);
        }

        public function deleteAllStudentAttendance($student_id){
            $attendance = Attendance::where('student_id',$student_id)->get();
                          Attendance::where('student_id',$student_id)->delete();
            // $attendance->delete();

            return $this->successResponse('Students Attendance Succesfully Deleted');
        }

        public function deleteAllEventAttendance($event_id){
            $attendance = Attendance::where('event_id',$event_id)->get();
                          Attendance::where('event_id',$event_id)->delete();
            // $attendance->delete();

            return $this->successResponse('All Event Attendance Succesfully Deleted');
        }
    }