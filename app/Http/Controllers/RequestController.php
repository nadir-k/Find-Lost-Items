<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Requests;
use App\LostItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveMail;
use App\Mail\DisapproveMail;
use Auth;

class RequestController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['index', 'show']
        ]);
    }

    //Shows all the requests made by users
    public function index(){

        //Only admin should be allowed to access the list of requests

        $requests = Requests::all();
        return view('requests.index')->with('requests', $requests);
    }

    //Allows a user to create a request
    public function create($id){

        /**
         * Takes in an item which gets passed to the database
         * This allows admin to see what item has been requested
        */
        $posts = LostItem::find($id);
        return view('requests.create')->with('posts', $posts);
    }

    //Stores a request into the database
    public function store(Request $request){

        //checks to see if the reason has been provided
        $this->validate($request, [
            'reason' => 'required'
        ]);

        //Creates a request
        $requests = new Requests();
        $requests->reason = $request->input('reason');
        $requests->status = $request->input('status');
        $requests->user_id = auth()->user()->id;
        $requests->item_id = $request->input('id');

        //sends the request to the database
        $requests->save();

        return redirect('/posts')->with('success', 'A member will be reviewing your request shortly');
    }

    //Displays the request based on the id passed
    public function show($id){

        $requests = Requests::find($id);
        return view('requests.show')->with('requests', $requests);
    }

    //Deletes the request from the database
    public function destroy($id){

        $requests = Requests::find($id);
        $requests->delete();
        return redirect('/requests');
    }

    //Changes the status to approved on a request
    public function approve($id){

        $requests = Requests::find($id);
        $requests->status = 'Approved';
        $requests->save();

        return redirect('/requests');
    }

    //Changes the status to revoked on a request
    public function disapprove($id){

        $requests = Requests::find($id);
        $requests->status = 'Revoked';
        $requests->save();

        return redirect('/requests');
    }

    /**
     * Function to send an email to a user approving the request
     */
    public function approveRequest($id){

        //Finds id of the request
        $user = Requests::find($id);     
        /**
         * Gets user_id from requests table which is a foreign key to the id in Users
         * so that the email can be accessed from it
         */
        Mail::to($user->user->email)->send(new ApproveMail());
        
        return $this->approve($id)->with('success', 'Email sent to user successfully');
    }

    /**
     * Function to send an email to a user disapproving the request
     */
    public function disapproveRequest($id){
        
        $user = Requests::find($id);     
        Mail::to($user->user->email)->send(new DisapproveMail());

        return $this->disapprove($id)->with('success', 'Email sent to user successfully');
    }


}
