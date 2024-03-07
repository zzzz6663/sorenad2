<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Faq;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $tickets = Ticket::query();

        if ($request->search) {
            $search = $request->search;
            $tickets->where('name', 'LIKE', "%{$search}%")
                ->orWhere('family', 'LIKE', "%{$search}%")
                ->orWhere('mobile', 'LIKE', "%{$search}%");
        }


        if ($request->status) {
            $tickets->where('status', $request->status);
        }
        if ($request->from) {
            $request->from = $user->convert_date($request->from);
            $tickets->where('created_at', '>', $request->from);
        }
        if ($request->to) {
            $request->to = $user->convert_date($request->to);
            $tickets->where('created_at', '<', $request->to);
        }



        // if ($request->search) {
        //     $search = $request->search;
        //     $faqs->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }
        // $tickets->where("customer_id", $user->id);
        $tickets = $tickets
            ->latest()->paginate(10);
        return view('advertiser.ticket.all', compact(['tickets']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('advertiser.ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:256',
            'customer_id' => 'required',
            'content' => 'required',
            'attach' => 'nullable|max:1024',
        ]);
        $user = auth()->user();

        $data['status'] = 'wait_for_customer';

        $ticket = Ticket::create($data);

        $data['number'] = $ticket->id + 100;
        $ticket->update($data);
        $answer = Answer::create([
            'ticket_id' => $ticket->id,
            'customer_id' => $data['customer_id'],
            'answer' => $data['content'],
        ]);
        if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $answer->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/ticket/attach/'), $name_img);
            $answer->update(['attach' => $name_img]);
        }
        $answer->ticket->customer->logs()->create([
            'type'=>"new_answer",
            'answer_id'=> $answer->id,
        ]);
        alert()->success('سوال با موفقیت ساخته شد ');
        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $userticket)
    {
        $answers=$userticket->answers()->oldest()->get();
        $user=auth()->user();
        return view('advertiser.ticket.show',compact('userticket','user',"answers"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, faq $faq)
    {
        return view('admin.faq.edit', compact(['faq']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faq $faq)
    {
        $data = $request->validate([
            'title' => 'required|max:256',
            'content' => 'required',
        ]);
        $faq->update($data);
        alert()->success('سوال با موفقیت به روز  شد ');
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(faq $faq)
    {
        $faq->delete();
        alert()->success('سوال با موفقیت حذف شد ');
        return redirect()->route('faq.index');
    }
    public function new_answer(Ticket $ticket ,Request $request)
    {
        $user=auth()->user();
        $data=  $request->validate([
            'answer'=>"required",
        ]);

        if($user->role=="admin"){
            $data['user_id'] = $user->id;
        $data['status'] = 'wait_for_customer';


        }


        if($user->role=="customer"){
            $data['customer_id'] = $user->id;
        $data['status'] = 'wait_for_admin';


        }

        $ticket->update(['status'=> $data['status'] ]);
        dd($data);
        $answer= $ticket->answers()->create($data);
        if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $answer->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/ticket/attach/'), $name_img);
            $answer->update(['attach' => $name_img]);
        }

        alert()->success('اطعات با موفقیت ثبت شد ');
        return redirect()->route('userticket.show',$ticket->id);
    }
}
