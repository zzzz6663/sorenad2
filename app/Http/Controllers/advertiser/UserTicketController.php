<?php

namespace App\Http\Controllers\advertiser;

use Carbon\Carbon;
use App\Models\Faq;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Ticket;

class UserTicketController extends Controller
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
        // if ($request->search) {
        //     $search = $request->search;
        //     $faqs->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }
        $tickets->where("customer_id", $user->id);
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
            'content' => 'required',
            'attach' => 'nullable|max:1024',
        ]);
        $user = auth()->user();

        $data['customer_id'] = $user->id;
        $data['status'] = 'wait_for_admin';

        $ticket = Ticket::create($data);

        $data['number'] = $ticket->id + 100;
        $ticket->update($data);
        $answer = Answer::create([
            'ticket_id' => $ticket->id,
            'customer_id' => $user->id,
            'answer' => $data['content'],
        ]);
        if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $answer->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/ticket/attach/'), $name_img);
            $answer->update(['attach' => $name_img]);
        }

        alert()->success('سوال با موفقیت ساخته شد ');
        return redirect()->route('userticket.index');
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
    public function close_ticket(Ticket $ticket ,Request $request)
    {
        $ticket->update(['status'=>"close"]);
        alert()->success("تیکت با موفقیت بسته شد");
        return back();

    }

    public function new_answer(Ticket $ticket ,Request $request)
    {
        $user=auth()->user();
        $data=  $request->validate([
            'answer'=>"required",
        ]);
        // $ticket->update(['status'=>"wait_for_admin"]);
        // $data['customer_id']=$user->id;
        if($user->role=="admin"){
            $data['user_id'] = $user->id;
        $data['status'] = 'wait_for_customer';


        }


        if($user->role=="customer"){
            $data['customer_id'] = $user->id;
        $data['status'] = 'wait_for_admin';


        }
        $ticket->update(["status"=> $data['status']]);
        $answer= $ticket->answers()->create($data);
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
        alert()->success('جواب با موفقیت ثبت شد ');
        return redirect()->route('userticket.show',$ticket->id);
    }
}
