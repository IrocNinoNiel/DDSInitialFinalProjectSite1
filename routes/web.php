<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Api Student
$router->group(['prefix' => 'api/student'],function () use ($router) {
    $router->get('/get',['uses' => 'StudentController@getStudents']);
    $router->get('/get/{student_id}',['uses' => 'StudentController@getStudent']);
    $router->post('/add',['uses' => 'StudentController@addStudent']);
    $router->put('/edit/{student_id}',['uses' => 'StudentController@updateStudent']);
    $router->delete('/delete/{student_id}',['uses' => 'StudentController@deleteStudent']);

});

// Api Event
$router->group(['prefix' => 'api/event'],function () use ($router) {
    $router->get('/get',['uses' => 'EventController@getEvents']);
    $router->get('/get/{event_id}',['uses' => 'EventController@getEvent']);
    $router->post('/add',['uses' => 'EventController@addEvent']);
    $router->put('/edit/{event_id}',['uses' => 'EventController@updateEvent']);
    $router->delete('/delete/{event_id}',['uses' => 'EventController@deleteEvent']);

});

// Api Attendance
$router->group(['prefix' => 'api/attendance'],function () use ($router) {
    $router->get('/get',['uses' => 'AttendanceController@getAttendances']);
    $router->get('/get/event/{event_id}',['uses' => 'AttendanceController@getEventAttendance']);
    $router->get('/get/student/{student_id}',['uses' => 'AttendanceController@getStudentAttendance']);
    $router->post('/add',['uses' => 'AttendanceController@addAttendance']);
    $router->delete('/delete/student/{student_id}',['uses' => 'AttendanceController@deleteAllStudentAttendance']);
    $router->delete('/delete/event/{event_id}',['uses' => 'AttendanceController@deleteAllEventAttendance']);
    
});

// Api User
$router->group(['prefix' => 'api/user'],function () use ($router) {
    $router->get('/get',['uses' => 'UserController@getUsers']);
    $router->get('/get/{user_id}',['uses' => 'UserController@getUser']);
    $router->post('/add',['uses' => 'UserController@addUser']);
    $router->delete('/delete/{user_id}',['uses' => 'UserController@deleteUser']);
    $router->put('/edit/{user_id}',['uses' => 'UserController@updateUser']);

    $router->post('/login',['uses' => 'UserController@verifyUser']);
   
});


// Api Fee
$router->group(['prefix' => 'api/fee'],function () use ($router) {
    $router->get('/get',['uses' => 'FeeController@getFees']);
    $router->get('/get/{fee_id}',['uses' => 'FeeController@getFee']);
    $router->get('/get/student/{student_id}',['uses' => 'FeeController@findIfStudentPay']);
    $router->post('/add',['uses' => 'FeeController@addFee']);
    $router->put('/edit/{fee_id}',['uses' => 'FeeController@updateFee']);
    $router->delete('/delete/{student_id}',['uses' => 'FeeController@deleteStudentFee']);

});