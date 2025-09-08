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
        $data = $request->validate([
            'quantity'=>'required|integer|min:0',
            'expires_at'=>'required|date|after:'.now(),
            'type'=>'required',
            'system'=>'required',
            'max_usage'=>'required|integer|min:1',
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
        return back()->with('Ticketmsg', 'This token does not exist.');
    }

    // Check if the ticket usage has reached its maximum limit
    if ($ticket->User()->count() >= $ticket->max_usage) {
        return back()->with('Ticketmsg', 'This ticket has reached its usage limit.');
    }

    // Check if the user has already registered this ticket
    // dd(Auth::user()->Ticket()->where('tickets.id',$ticket->id)->get());
    if (Auth::user()->Ticket()->where('tickets.id',$ticket->id)->exists()) {
        return back()->with('Ticketmsg', 'You have already registered this ticket.');
    }
    if (Auth::user()->Ticket()->where('tickets.expires_at','<',now())->exists()) {
        return back()->with('Ticketmsg', 'Ticket has expired.');
    }
    // dd($ticket);

    // Attach the ticket to the user
    Auth::user()->Ticket()->attach($ticket->id);

    return back()->with('Ticketmsg', 'You have successfully registered.');
}
public function delete($id){
    Ticket::find($id)->delete();
    return back()->with('msg','Ticket deleted successfully');
}
   public function detach($id){
    auth()->user()->tickets()->detach($id);
    return back()->with('Ticketmsg', 'Ticket detached successfully. You wont be able access content using this ticket again');
}
}
