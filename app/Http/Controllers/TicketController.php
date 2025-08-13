<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\ContributableSystems;


class TicketController extends Controller
{
    public function index(){
        $systems = System::withoutGlobalScope(new ContributableSystems)->where('creator',Auth::user()->id)->get();
        $SystemsWithTickets = System::where('creator',Auth::user()->id)->whereHas('tickets')->get();
        $tickets = Auth::user()->Ticket()->get();
        return view('pages.ticket-setting',compact(['systems','SystemsWithTickets','tickets']));
    }
    public function CreateTickets(Request $request){
        $data =$request->validate([
            'quantity'=>'required|integer|min:2|max:30',
            'expires_at'=>'required|date|after:'.now(),
            'type'=>'required',
            'system'=>'required',
            'max_usage'=>'required'
        ]);
        // dd($data);
        for ($i=0; $i < $request->quantity; $i++) {

           Ticket::create([
                'system'=>$request->input('system'),
                'type'=>$request->input('type'),
                'expires_at'=> $request->input('expires_at'),
                'token'=>ArcCode(),
                'max_usage'=>$request->input('max_usage')
           ]);
        }
        return redirect()->route('pages.manage.tickets',['id'=>$request->input('system')]);
    }
    public function show($id){
        $system = System::find($id);
        $tickets = $system->tickets()->orderBy('created_at','desc')->paginate(10);
        return view('pages.manage.tickets',compact(['system','tickets']));
    }
    public function register($token)
{
    $ticket = Ticket::where('token', $token)->first();

    // Check if the ticket exists
    if (!$ticket) {
        return back()->with('msg', 'This token does not exist.');
    }

    // Check if the ticket usage has reached its maximum limit
    if ($ticket->Users()->count() >= $ticket->max_usage) {
        return back()->with('msg', 'This ticket has reached its usage limit.');
    }

    // Check if the user has already registered this ticket
    if (Auth::user()->tickets->contains($ticket->id)) {
        return back()->with('msg', 'You have already registered this ticket.');
    }

    // Attach the ticket to the user
    Auth::user()->Ticket()->attach($ticket->id);

    return back()->with('TicketMsg', 'You have successfully registered.');
}
public function delete($id){
    Ticket::find($id)->delete();
    return back()->with('msg','Ticket deleted successfully');
    }

}
