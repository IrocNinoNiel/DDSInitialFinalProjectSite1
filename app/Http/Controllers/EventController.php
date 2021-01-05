<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Event;
    use Illuminate\Http\Response;
    use App\Traits\ApiResponser;

    Class EventController extends Controller {   
        use ApiResponser;
        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }

        public function getEvents(){

            $event = Event::all();
            return $this->successResponse($event);

        }

        public function getEvent($event_id){
            $event = Event::find($event_id);
            if($event == null) return $this->errorResponse('No Such Event in the database',404);
            return $this->successResponse($event);
        }

        public function addEvent(Request $request){
            $rules = [
                'event_name' => 'required|max:255',
            ];

            $this->validate($request, $rules);

            $event = new Event;

            $event->event_name = $request->event_name;

            $event->save();

            return $this->successResponse($event);
        }

        public function updateEvent(Request $request, $event_id){
            $rules = [
                'event_name' => 'required|max:255',
            ];

            $this->validate($request, $rules);

            $event = Event::find($event_id);
            if($event == null) return $this->errorResponse('No Such Event in the database',404);

            $event->event_name = $request->event_name;

            $event->save();

            return $this->successResponse($event);
        }

        public function deleteEvent($event_id){
            $event = Event::find($event_id);
            if($event == null) return $this->errorResponse('No Such Event in the database',404);

            $event->delete();
            return $this->successResponse('Event Succesfully Deleted');
        }

    }