<?php

namespace App\Http\Controllers;

use App\Company;
use App\District;
use App\KkGTaCn;
use App\KkGTaCnCt;
use App\KkGTaCnCtDf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KkGTaCnController extends Controller
{
    public function ttdn(){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                if(session('admin')->level == 'T')
                    $model = Company::where('level','DVTACN')
                        ->get();
                elseif(session('admin')->level == 'H')
                    $model = Company::where('mahuyen',session('admin')->mahuyen)
                        ->where('level','DVTACN')
                        ->get();
                return view('manage.dvtacn.kkgia.kkgiadv.ttdn')
                    ->with('model', $model)
                    ->with('pageTitle', 'Danh sách doanh nghiệp kê khai giá thức ăn chăn nuôi');
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function index(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DVTACN' || session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();

                if(session('admin')->level == 'T' || session('admin')->level == 'H')
                    $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue'] : '';
                else
                    $inputs['masothue'] = session('admin')->maxa;
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
                $inputs['trangthai'] = isset($inputs['trangthai']) ? $inputs['trangthai'] : 'chochuyen';
                if ($inputs['trangthai'] == 'chochuyen')
                    $trangthai = 'Chờ chuyển';
                elseif ($inputs['trangthai'] == 'choduyet')
                    $trangthai = 'Chờ duyệt';
                elseif ($inputs['trangthai'] == 'daduyet')
                    $trangthai = 'Đã duyệt';
                elseif ($inputs['trangthai'] == 'bitralai')
                    $trangthai = 'Bị trả lại';

                $model = KkGTaCn::where('maxa', $inputs['masothue'])
                    ->whereYear('ngaynhap', $inputs['nam'])
                    ->where('trangthai', $trangthai)
                    ->orderBy('id', 'desc')
                    ->get();
                $modeldn = Company::where('maxa', $inputs['masothue'])
                    ->where('level', 'DVTACN')->first();

                return view('manage.dvtacn.kkgia.kkgiadv.index')
                    ->with('model', $model)
                    ->with('modeldn', $modeldn)
                    ->with('nam', $inputs['nam'])
                    ->with('trangthai', $inputs['trangthai'])
                    ->with('masothue', $inputs['masothue'])
                    ->with('pageTitle', 'Danh sách hồ sơ kê khai giá thức ăn chăn nuôi');
            } else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //Kiểm tra có thuộc sự quản lý hay k
            $check = Company::where('maxa',$inputs['masothue'])
                ->where('level','DVTACN')->count();
            if (session('admin')->level == 'T'
                || session('admin')->level == 'H' && $check > 0
                || session('admin')->level == 'DVTACN' && session('admin')->maxa = $inputs['masothue']) {
                $modeldelctdf = KkGTaCnCtDf::where('maxa',$inputs['masothue'])->delete();

                $modeldn = Company::where('maxa', $inputs['masothue'])
                    ->where('level', 'DVTACN')->first();

                $datenow = date('Y-m-d');
                $ngayhieuluc = date('d/m/Y', strtotime(getNgayHieuLuc($datenow,'DVTACN')));
                $ngaynhap = date('d/m/Y', strtotime($datenow));

                return view('manage.dvtacn.kkgia.kkgiadv.create')
                    ->with('modeldn', $modeldn)
                    ->with('maxa', $inputs['masothue'])
                    ->with('ngaynhap', $ngaynhap)
                    ->with('ngayhieuluc', $ngayhieuluc)
                    ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');

            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DVTACN' || session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $inputs['mahs'] = $inputs['maxa'].getdate()[0];
                $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                if($inputs['ngaycvlk'] != '')
                    $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
                else
                    unset($inputs['ngaycvlk']);
                $inputs['trangthai'] = 'Chờ chuyển';
                $model = new KkGTaCn();
                if($model->create($inputs)){
                    $modelctdf = KkGTaCnCtDf::where('maxa',$inputs['maxa'])->get();
                    foreach($modelctdf as $ctdf){
                        $modelct = new KkGTaCnCt();
                        $modelct->maxa = $inputs['maxa'];
                        $modelct->mahuyen = $inputs['mahuyen'];
                        $modelct->mahs = $inputs['mahs'];
                        $modelct->tenhh= $ctdf->tenhh;
                        $modelct->qccl= $ctdf->qccl;
                        $modelct->dvt= $ctdf->dvt;
                        $modelct->ghichu= $ctdf->ghichu;

                        $modelct->cpnvlttlk= $ctdf->cpnvlttlk;
                        $modelct->cpncttlk= $ctdf->cpncttlk;
                        $modelct->cpsxclk= $ctdf->cpsxclk;
                        $modelct->cpnvpxlk= $ctdf->cpnvpxlk;
                        $modelct->cpvllk= $ctdf->cpvllk;
                        $modelct->cpdcsxlk= $ctdf->cpdcsxlk;
                        $modelct->cpkhtscdlk= $ctdf->cpkhtscdlk;
                        $modelct->cpdvmnlk= $ctdf->cpdvmnlk;
                        $modelct->cpbtklk= $ctdf->cpbtklk;
                        $modelct->cpklk= $ctdf->cpklk;
                        $modelct->tcpsxlk= $ctdf->tcpsxlk;
                        $modelct->cpbhlk= $ctdf->cpbhlk;
                        $modelct->cpqldnlk= $ctdf->cpqldnlk;
                        $modelct->cptclk= $ctdf->cptclk;
                        $modelct->tgttblk= $ctdf->tgttblk;
                        $modelct->lndklk= $ctdf->lndklk;
                        $modelct->gbctlk= $ctdf->gbctlk;
                        $modelct->thuettdblk= $ctdf->thuettdblk;
                        $modelct->thuegtgtlk= $ctdf->thuegtgtlk;
                        $modelct->gbdctlk= $ctdf->gbdctlk;

                        $modelct->cpnvltt= $ctdf->cpnvltt;
                        $modelct->cpnctt= $ctdf->cpnctt;
                        $modelct->cpsxc= $ctdf->cpsxc;
                        $modelct->cpnvpx= $ctdf->cpnvpx;
                        $modelct->cpvl= $ctdf->cpvl;
                        $modelct->cpdcsx= $ctdf->cpdcsx;
                        $modelct->cpkhtscd= $ctdf->cpkhtscd;
                        $modelct->cpdvmn= $ctdf->cpdvmn;
                        $modelct->cpbtk= $ctdf->cpbtk;
                        $modelct->cpk= $ctdf->cpk;
                        $modelct->tcpsx= $ctdf->tcpsx;
                        $modelct->cpbh= $ctdf->cpbh;
                        $modelct->cpqldn= $ctdf->cpqldn;
                        $modelct->cptc= $ctdf->cptc;
                        $modelct->tgttb= $ctdf->tgttb;
                        $modelct->lndk= $ctdf->lndk;
                        $modelct->gbct= $ctdf->gbct;
                        $modelct->thuettdb= $ctdf->thuettdb;
                        $modelct->thuegtgt= $ctdf->thuegtgt;
                        $modelct->gbdct= $ctdf->gbdct;
                        $modelct->save();
                    }
                }
                return redirect('kkthucanchannuoi?&masothue='.$inputs['maxa']);
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            //Kiểm tra có thuộc sự quản lý hay k

            $model = KkGTaCn::findOrFail($id);
            $check = Company::where('mahuyen',$model->mahuyen)
                ->where('level','DVTACN')->count();
            if (session('admin')->level == 'T'
                || session('admin')->level == 'H' && $check > 0 && canEdit($model->trangthai)
                || session('admin')->level == 'DVTACN' && session('admin')->maxa == $model->maxa && canEdit($model->trangthai)) {

                $modeldn = Company::where('maxa', $model->maxa)
                    ->where('level', 'DVTACN')->first();
                $modelct = KkGTaCnCt::where('mahs',$model->mahs)
                    ->get();

                return view('manage.dvtacn.kkgia.kkgiadv.edit')
                    ->with('modeldn', $modeldn)
                    ->with('model',$model)
                    ->with('modelct',$modelct)
                    ->with('pageTitle', 'Chỉnh sửa kê khai giá thức ăn chăn nuôi');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DVTACN' || session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                if($inputs['ngaycvlk'] != '')
                    $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
                else
                    unset($inputs['ngaycvlk']);
                $model = KkGTaCn::findOrFail($id);
                $model->update($inputs);
                if ($model->trangthai == 'Chờ chuyển')
                    $trangthai = 'chochuyen';
                elseif ($model->trangthai == 'Chờ duyệt')
                    $trangthai = 'choduyet';
                elseif ($model->trangthai == 'Đã duyệt')
                    $trangthai = 'daduyet';
                elseif ($model->trangthai == 'Bị trả lại')
                    $trangthai = 'bitralai';
                return redirect('kkthucanchannuoi?&masothue='.$inputs['maxa'].'&trangthai='.$trangthai);
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $mahs = $input['mahs'];
            $modelkk = KkGTaCn::where('mahs',$mahs)->first();
            $modeldn = Company::where('maxa',$modelkk->maxa)
                ->where('level','DVTACN')
                ->first();
            $modelkkct = KkGTaCnCt::where('mahs',$modelkk->mahs)
                ->get();
            $modelcqcq = District::where('mahuyen',$modeldn->mahuyen)
                ->first();
            return view('reports.kkgdvtacn.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Kê khai giá thức ăn chăn nuôi');

        }else
            return view('errors.notlogin');
    }

    public function kiemtra(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkGTaCn::where('id',$inputs['id'])
                ->first();

            $result['message'] = '<div class="form-group" id="tthschuyen">';
            $result['message'] .= '<label> Số CV: '.$model->socv.'- Ngày áp dụng: '.getDayVn($model->ngayhieuluc).'</label>';
            $result['message'] .= '</div>';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function chuyen(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DVTACN' || session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $model = KkGTaCn::where('id',$inputs['idchuyen'])
                    ->first();
                $inputs['trangthai'] = 'Chờ duyệt';
                $inputs['ngaychuyen'] = Carbon::now()->toDateTimeString();
                if($model->update($inputs)){
                    $tencqcq = District::where('mahuyen',$model->mahuyen)->first();
                    $dn = Company::where('maxa',$model->maxa)
                        ->where('level','DVTACN')
                        ->first();
                    $data=[];
                    $data['tendn'] = $dn->tendn;
                    $data['masothue'] = $model->masothue;
                    $data['tg'] = $inputs['ngaychuyen'];
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['ttnguoinop'] = $inputs['ttnguoinop'];
                    $maildn = $dn->email;
                    $tendn = $dn->tendn;
                    $mailql = $tencqcq->emailql;
                    $tenql = $tencqcq->tendv;

                    Mail::send('mail.kkgia',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                        $message->to($maildn,$tendn)
                            ->to($mailql,$tenql)
                            ->subject('Thông báo nhận hồ sơ kê khai giá dịch vụ');
                        $message->from('phanmemcsdlgia@gmail.com','Phần mềm CSDL giá');
                    });
                }
                return redirect('kkthucanchannuoi?&masothue='.$model->maxa);
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function showlydo(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkGTaCn::where('id',$inputs['id'])
                ->first();

            $result['message'] = '<div class="form-group" id="showlydo">';
            $result['message'] = '<label>'.$model->lydo.'</lable>';
            $result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DVTACN' || session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $model = KkGTaCn::where('id',$inputs['iddelete'])
                    ->first();
                if($model->delete()){
                    $modelct = KkGTaCn::where('mahs',$model->mahs)
                        ->delete();
                }
                return redirect('kekhaigiasua?&masothue='.$model->maxa);
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }
}
