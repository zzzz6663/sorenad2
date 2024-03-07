<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use NumberFormatter;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'family',
        'mobile',
        'role',
        'active',
        'vip',
        'deleted',
        'avatar',
        'mellicode',
        'shaba',
        'cart',
        'account',
        'a_mellicode',
        'confirm_bank_account',
        'bank',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function advertises(){
        return $this->hasMany(Advertise::class);

    }
    public function transactions(){
        return $this->hasMany(Transaction::class);

    }
    public function withdrawals(){
        return $this->hasMany(Withdrawal::class);

    }
    public function tickets(){
        return $this->hasMany(Ticket::class);

    }
    public function sites(){
        return $this->hasMany(Site::class);
    }
    public function logs(){
        return $this->hasMany(Log::class);
    }
    public function answer(){
        return $this->hasMany(Answer::class);
    }
    public function balance(){
        return $this->transactions()->whereIn("status",["wait_for_admin_confirm","payed"])->sum("amount");
    }
    public function unread_logs(){
        return $this->logs()->whereNull("seen");
    }

    public function avatar(){
        if($this->avatar){
            return asset("/media/users/avatar/".$this->avatar);
        }
        return "/site/images/avatar.png";
    }
    public function total_withdrawal(){
        return $this->withdrawals()->whereStatus("admin_confirmed")->sum("amount");
    }
    public function unread_message(){
        if($this->role=="admin"){
            return Ticket::whereHas("answers",function($query){
            // $query->whereSeen(null);
           })->whereStatus("wait_for_admin")->count();
        }

        if($this->role=="customer"){
            return Ticket::where("customer_id",$this->id)->whereHas("answers",function($query){
            // $query->whereSeen(null);
           })->whereStatus("wait_for_customer")->count();
        }
    }
    public function view_price(){
        return 25;
    }
    public function click_price(){
        return 500;
    }
    public function tax_percent(){

        $tax_percent_page_ad=Setting::whereName("tax_percent_page_ad")->first();
        return $tax_percent_page_ad->val;
    }
    public function unread_withdrawal(){
        if($this->role=="admin"){
            return Withdrawal::whereStatus("wait_for_admin_confirm")->count();
        }

        // if($this->role=="customer"){
        //     return Withdrawal::whereStatus("wait_for_admin_confirm")->count();
        // }
    }

    public function send_pattern($mobile,$pattern_code,$input_data){
        // $soapClient = new \SoapClient(
        //     storage_path($wsdlPath),
        //     array(
        //         'trace' => 1,
        //         'soap_version' => SOAP_1_2,
        //         'exceptions' => 1,
        //         'login' => config('services.soap.username'),
        //         'password' => config('services.soap.password'),
        //     )
        // );

        // $client = new \SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
        // $user = "09210375124";
        // $pass = "Modir@5124";
        // $fromNum = "+983000505";
        // $toNum = array($mobile);
        // $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data);
    }
    public function send_sms($mobile,$text){
		$url = "https://ippanel.com/services.jspd";
		$rcpt_nm = array($mobile);
		$param = array
					(
						'uname'=>'09210375124',
						'pass'=>'Modir@5124',
						'from'=>'+9810004223',
						'message'=>$text,
						'to'=>json_encode($rcpt_nm),
						'op'=>'send'
					);
		// $param = array
		// 			(
		// 				'uname'=>'09210375124',
		// 				'pass'=>'Modir@5124',
		// 				'originator'=>'3000505',
		// 				'pattern_code'=>'svr5y3c1ophdnuo',
		// 				'recipien'=>$mobile,
		// 				'values'=>[
        //                     'code'=>1212
        //                 ],
		// 			);

		$handler = curl_init($url);
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response2 = curl_exec($handler);

		$response2 = json_decode($response2);
		$res_code = $response2[0];
		$res_data = $response2[1];

                    dump($res_data);
		echo $res_data;


    }


    public function convert_date($from)
    {
        $date = explode('/', $from);
        $fmt = numfmt_create('fa', NumberFormatter::DECIMAL);
        $year = numfmt_parse($fmt, $date[0]);
        $month = numfmt_parse($fmt, $date[1]);
        $day = numfmt_parse($fmt, $date[2]);
        $from =  \Morilog\Jalali\CalendarUtils::toGregorian($year, $month, $day);
        $now=Carbon::now()->format("H:i:s");
        return   $from = $from[0] . '-' . $from[1] . '-' . $from[2] . ' '.  $now;
    }
}
