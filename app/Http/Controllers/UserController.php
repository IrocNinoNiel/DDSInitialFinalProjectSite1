<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Student;
    use  App\Models\User;
    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;

    Class UserController extends Controller {   
        use ApiResponser;
        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }

        public function verifyUser(Request $request){
            $user_name = $request->user_name;
            $user_pass = $request->user_pass;
            $isFound = false;

            $users = User::all();

            foreach($users as $user) {
                if($user->user_name == $user_name && $user->user_pass == $user_pass){
                    $isFound = true;
                    break;
                }
            }
            if(!$isFound) return $this->errorResponse('No Such User in the database',404);
            return $this->successResponse('User Verify');
        }

       
        public function getUsers(){

            $user = User::select('tbl_user.*')
            ->leftJoin('tbl_student','tbl_user.student_id','=','tbl_user.student_id')
            ->select('tbl_user.user_name','tbl_user.user_pass','tbl_student.student_name','tbl_student.student_year','tbl_student.student_gender','tbl_student.student_contact','tbl_student.student_email','tbl_user.role_id')->first();

            return $this->successResponse($user);

        }

        public function getUser($user_id){
            $user = User::find($user_id);
            if($user == null) return $this->errorResponse('No Such User in the database',404);

            $userCredentials = User::where('user_id',$user_id)
                ->leftJoin('tbl_student','tbl_user.student_id','=','tbl_student.student_id')
                ->select('tbl_user.user_name','tbl_user.user_pass','tbl_student.student_name','tbl_student.student_year','tbl_student.student_gender','tbl_student.student_contact','tbl_student.student_email','tbl_user.role_id')->first();
            return $this->successResponse($userCredentials);
        }

        public function addUser(Request $request){

            $rules = [
                'user_name' => 'required|max:50',
                'user_pass' => 'required:max:20',
                'student_id' => 'required|numeric|max:20'
            ];

            $this->validate($request, $rules);

            $user = new User;

            $user->user_name = $request->user_name;
            $user->user_pass = $request->user_pass;
            $user->student_id = $request->student_id;
            $user->teacher_id  = null;
            $user->role_id = 2;

            $user->save();

            return $this->successResponse($user);
        }

        public function updateUser(Request $request,$user_id) {
            $rules = [
                'user_name' => 'required|max:50',
                'user_pass' => 'required:max:20',
              
            ];

            $this->validate($request, $rules);

            $user = User::find($user_id);

            if($user == null) return $this->errorResponse('No Such User in the database',404);

            $user->user_name = $request->user_name;
            $user->user_pass = $request->user_pass;
            $user->student_id = $user->student_id;
            $user->teacher_id  = null;
            $user->role_id = 2;

            $user->save();

            return $this->successResponse($user);
        }

        public function deleteUser($user_id){
            $user = User::find($user_id);

            if($user == null) return $this->errorResponse('No Such User in the database',404);

            $user->delete();

            return $this->successResponse($user);
        }
    }