<?php

namespace App\Http\Controllers;

use App\Company;
use App\CsKdDvLt;
use App\District;
use App\DmDvQl;
use App\dmvitridat;
use App\DnDvGs;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\GeneralConfigs;
use App\KkDvVtKhac;
use App\KkDvVtXb;
use App\KkDvVtXk;
use App\KkDvVtXtx;
use App\KkGDvGs;
use App\KkGDvLt;
use App\KkGDvTaCn;
use App\Register;
use App\TtDn;
use App\TtQd;
use App\Users;
use App\ViewPage;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /*
     * Thông tin email
     *
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=giadvvinhphuc@gmail.com
    MAIL_PASSWORD=giadvvinhphuc123456
    MAIL_ENCRYPTION=tls
     * */
    public function index()
    {
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'sa' )
                return redirect('general');
            else{
                return view('dashboard')
                    ->with('pageTitle','Tổng quan');
            }
        }else{
            return view('welcome');
        }
    }

    public function forgotpassword(){
        return view('system.users.forgotpassword.index')
            ->with('pageTitle','Quên mật khẩu???');
    }

    public function forgotpasswordw(Request $request){

        $input = $request->all();
        $model = Users::where('username',$input['username'])->first();
        if(isset($model)){
            if($model->email == $input['email']){
                $npass = getRandomPassword();
                $model->password = md5($npass);
                $model->save();

                $data = [];
                $data['tendn'] = $model->name;
                $data['username'] = $model->username;
                $data['npass'] = $npass;
                $maildn = $model->email;
                $tendn = $model->name;

                Mail::send('mail.successnewpassword', $data, function ($message) use ($maildn,$tendn) {
                    $message->to($maildn,$tendn)
                        ->subject('Thông báo thay đổi mật khẩu tài khoản');
                    $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                });
                return view('errors.forgotpass-success');
            }else
                return view('errors.forgotpass-errors');
        }else
            return view('errors.forgotpass-errors');

    }

    public function ghichuct(){
        return view('system.ghichuct.index')
            ->with('pageTitle','Ghi chú chương trình');
    }
}
