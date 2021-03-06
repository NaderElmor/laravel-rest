<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{


    public function __construct()
    {
        // $this->middleware('name');
    }


    public function index()
    {
       $meetings = Meeting::all();

       foreach($meetings as $meeting){

       //set this view_meeting property for just get back to the user with this info (it is not into the db)
        $meeting->view_meeting = [

            'href' => 'api/v1/meeting/' . $meeting->id,
             'method' => 'GET'

        ];

       }

        $response = [
            'msg'      => 'List of all Meetings',
            'meetings' => $meetings

        ];
        return response()->json($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'time' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required'
        ]);



        //Recieve request data in variables
        $title       = $request->input('title');
        $description = $request->input('description');
        $time        = $request->input('time');
        $user_id     = $request->input('user_id');

        //Store it in associative array {because we can't type json here}
        $meeting = [
            'title'        => $title,
            'description'  => $description,
            'time'         => $time,
            'user_id'      => $user_id,
            'view_meeting' =>
             [
                'href'   => 'api/v1/meeting/1',
                'method' => 'GET'
             ]
        ];


        // Make the response content ( Store it in associative array {because we can't type json here})
        $response = [
            'msg' => 'Meeting created',
            'meeting' => $meeting
        ];

        //json() will tranform the arrays into json format
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "it works";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'time' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $time = $request->input('time');
        $user_id = $request->input('user_id');
        $meeting = [
            'title' => $title,
            'description' => $description,
            'time' => $time,
            'user_id' => $user_id,
            'view_meeting' => [
                'href' => 'api/v1/meeting/1',
                'method' => 'GET'
            ]
        ];

        $response = [
            'msg' => 'Meeting updated',
            'meeting' => $meeting
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $response = [
            'msg' => 'Meeting deleted',
            'create' => [
                'href' => 'api/v1/meeting',
                'method' => 'POST',
                'params' => 'title, description, time'
            ]
        ];

        return response()->json($response, 200);

    }
}
