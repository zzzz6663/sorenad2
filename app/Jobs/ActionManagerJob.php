<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ActionManagerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $all=Action::where('active', 1);
        $arr= $all->pluck("id")->toArray();
        $all_action=$all->distinct()->pluck('site_id');
        $admin=User::find(1);

        $transaction = $admin->transactions()->create([
            'amount' => $all->get()->sum("admin_share"),
            'transactionId' => "7171",
            'type' => "clear",
            'pay_type' => "",
            'advertise_id' => null,
            'status' => "payed",
        ]);
        foreach(   $all_action as $action){
            $site_actions=Action::where("site_id",$action)->whereIn('id', $arr)->get()->sum("site_share");
            dump($site_actions);
          $site_owner=User::find($action);
          $transaction = $site_owner->transactions()->create([
            'amount' =>  $site_actions,
            'transactionId' => "7171",
            'type' => "clear",
            'pay_type' => "",
            'advertise_id' =>null,
            'status' => "payed",
        ]);
        }

        Action::whereIn('id', $arr)->update(['active'=>0]);
    }
}
