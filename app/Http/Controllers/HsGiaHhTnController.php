<?php

namespace App\Http\Controllers;

use App\DmHhTn;
use App\DmLoaiGia;
use App\DmLoaiHh;
use App\DmThiTruong;
use App\DmThoiDiem;
use App\GiaHhTn;
use App\GiaHhTnDefault;
use App\HsGiaHhTn;
use App\NhomTn;
use App\TtPhongBan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HsGiaHhTnController extends Controller
{
    public function thoidiem()
    {
        if(Session::has('admin')){
            $model = DmThoiDiem::where('plbc','Hàng hóa, dịch vụ')
                ->get();
            return view('manage.giahhdv.hhdvtn.thoidiem.index')
                ->with('model',$model)
                ->with('pageTitle','Chọn thời điểm nhập báo cáo giá hàng hóa dịch vụ trong nước');
        }else
            return view('errors.notlogin');
    }

    public function index($thoidiem,$nam,$pb)
    {
        if(Session::has('admin')){
            if($pb == 'all')
                $model = HsGiaHhTn::where('mathoidiem',$thoidiem)
                    ->where('nam',$nam)
                    //->where('trangthai','Công bố')
                    ->get();
            else
                if($pb == session('admin')->mahuyen)
                    $model = HsGiaHhTn::where('mathoidiem',$thoidiem)
                        ->where('nam',$nam)
                        ->where('mahuyen',$pb)
                        ->get();
                else
                    $model = HsGiaHhTn::where('mathoidiem',$thoidiem)
                        ->where('nam',$nam)
                        ->where('mahuyen',$pb)
                        //->where('trangthai','Công bố')
                        ->get();

            $modelpb = TtPhongBan::all();

            foreach($model as $tt){
                $this->getTtPhongBan($modelpb,$tt);
            }

            return view('manage.giahhdv.hhdvtn.index')
                ->with('model',$model)
                ->with('modelpb',$modelpb)
                ->with('thoidiem',$thoidiem)
                ->with('nam',$nam)
                ->with('pb',$pb)
                ->with('pageTitle','Thông tin hồ sơ giá hàng hóa dịch vụ trong nước');
        }else
            return view('errors.notlogin');
    }

    public function getTtPhongBan($pbs,$array){
            foreach($pbs as $pb){
                if($pb->ma == $array->mahuyen)
                    $array->tenpb = $pb->ten;
            }
    }

    public function create($thoidiem)
    {
        if(Session::has('admin')){
            $loaigia = DmLoaiGia::where('pl','Hàng hóa dịch vụ trong nước')->get();
            $loaihh = DmLoaiHh::all();
            $thitruong= DmThiTruong::all();
            $nhomhh = NhomTn::where('theodoi','Có')->get();
            $modeldel = GiaHhTnDefault::where('mahuyen',session('admin')->mahuyen)
                ->delete();
            return view('manage.giahhdv.hhdvtn.create')
                ->with('mathoidiem',$thoidiem)
                ->with('loaigia',$loaigia)
                ->with('loaihh',$loaihh)
                ->with('nhomhh',$nhomhh)
                ->with('thitruong',$thitruong)
                ->with('pageTitle','Thông tin giá hàng hóa dịch vụ thêm mới');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if(Session::has('admin')){
            $insert = $request->all();
            $date = date_create(getDateToDb($insert['tgnhap']));
            $thang = date_format($date,'m');
            $mahs = getdate()[0];

            $model = new HsGiaHhTn();
            $model->tgnhap = getDateToDb($insert['tgnhap']);
            $model->thitruong = $insert['thitruong'];
            $model->maloaihh = $insert['maloaihh'];
            $model->maloaigia = $insert['maloaigia'];

            if($thang == 1 || $thang == 2 || $thang == 3)
                $model->quy = 1;
            elseif($thang == 4 || $thang == 5 || $thang == 6)
                $model->quy = 2;
            elseif($thang == 7 || $thang == 8 || $thang == 9)
                $model->quy = 3;
            else
                $model->quy = 4;
            $model->thang = date_format($date,'m');
            $model->nam = date_format($date,'Y');
            $model->mahuyen = session('admin')->mahuyen;
            $model->mahs = $mahs;
            $model->mathoidiem = $insert['mathoidiem'];
            if($model->save()){
                $this->createts($mahs);
            }

            return redirect('giahhdv-trongnuoc/thoidiem='.$insert['mathoidiem'].'/nam='.date_format($date,'Y').'&pb='.session('admin')->mahuyen);

        }else
            return view('errors.notlogin');
    }

    public function createts($mahs){
        $modelts = GiaHhTnDefault::where('mahuyen',session('admin')->mahuyen)
            ->get();
        if(count($modelts) > 0) {
            foreach ($modelts as $ts) {
                $model = new GiaHhTn();
                $model->masopnhom = $ts->masopnhom;
                $model->mahh = $ts->mahh;
                $model->giatu  =$ts->giatu;
                $model->giaden = $ts->giaden;
                $model->soluong = $ts->soluong;
                $model->nguontin = $ts->nguontin;
                $model->gc = $ts->gc;
                $model->mahs = $mahs;
                $model->save();
            }
        }
    }

    public function show($id)
    {
        if(Session::has('admin')){
            $model = HsGiaHhTn::findOrFail($id);
            $modeltthh = GiaHhTn::where('mahs',$model->mahs)
                ->get();
            $loaigia = DmLoaiGia::where('pl','Hàng hóa dịch vụ trong nước');
            $loaihh = DmLoaiHh::all();
            $thitruong= DmThiTruong::all();
            //dd($thitruong);
            $modeldm = DmHhTn::all();

            foreach($modeltthh as $tthh){
                $this->gettenhh($modeldm,$tthh);
            }
            return view('manage.giahhdv.hhdvtn.show')
                ->with('model',$model)
                ->with('modeltthh',$modeltthh)
                ->with('loaigia',$loaigia)
                ->with('loaihh',$loaihh)
                ->with('thitruong',$thitruong)
                ->with('pageTitle','Thông tin giá hàng hóa dịch vụ chi tiết');
        }else
            return view('errors.notlogin');
    }

    public function edit($id)
    {
        if(Session::has('admin')){
            $model = HsGiaHhTn::findOrFail($id);
            $modeltthh = GiaHhTn::where('mahs',$model->mahs)
                ->get();

            $modeldm = DmHhTn::all();

            foreach($modeltthh as $tthh){
                $this->gettenhh($modeldm,$tthh);
            }

            //dd($modeltthh);
            $loaigia = DmLoaiGia::where('pl','Hàng hóa dịch vụ trong nước');
            $loaihh = DmLoaiHh::all();
            $thitruong= DmThiTruong::all();
            $nhomhh = NhomTn::where('theodoi','Có')
                ->get();
            //dd($modeltthh);
            return view('manage.giahhdv.hhdvtn.edit')
                ->with('model',$model)
                ->with('modeltthh',$modeltthh)
                ->with('loaigia',$loaigia)
                ->with('loaihh',$loaihh)
                ->with('nhomhh',$nhomhh)
                ->with('thitruong',$thitruong)
                ->with('pageTitle','Thông tin giá hàng hóa dịch vụ chi tiết');
        }else
            return view('errors.notlogin');
    }

    public function gettenhh($mahh,$array){
        foreach($mahh as $tt){
            if($tt->masopnhom == $array->masopnhom && $tt->mahh == $array->mahh){
                $array->tenhh = $tt->tenhh;
                break;
            }
        }
    }

    public function update(Request $request, $id)
    {
        if(Session::has('admin')){
            $insert = $request->all();
            $date = date_create(getDateToDb($insert['tgnhap']));
            $thang = date_format($date,'m');

            $model = HsGiaHhTn::findOrFail($id);
            $model->tgnhap = getDateToDb($insert['tgnhap']);
            $model->thitruong = $insert['thitruong'];
            $model->maloaihh = $insert['maloaihh'];
            $model->maloaigia = $insert['maloaigia'];

            if($thang == 1 || $thang == 2 || $thang == 3)
                $model->quy = 1;
            elseif($thang == 4 || $thang == 5 || $thang == 6)
                $model->quy = 2;
            elseif($thang == 7 || $thang == 8 || $thang == 9)
                $model->quy = 3;
            else
                $model->quy = 4;
            $model->thang = date_format($date,'m');
            $model->nam = date_format($date,'Y');
            $model->save();

            return redirect('giahhdv-trongnuoc/thoidiem='.$model->mathoidiem.'/nam='.date_format($date,'Y').'&pb='.$model->mahuyen);

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if(Session::has('admin')){
            $input = $request->all();
            $model = HsGiaHhTn::where('id',$input['iddelete'])
                ->first();
            //dd($model);
            if($model->delete())
                $modelct = GiaHhTn::where('mahs',$model->mahs)
                    ->delete();

            return redirect('giahhdv-trongnuoc/thoidiem='.$model->mathoidiem.'/nam='.$model->nam.'&pb='.$model->mahuyen);

        }else
            return view('errors.notlogin');
    }

    public function search(){
        if(Session::has('admin')){
            $modelmaloaigia = DmLoaiGia::all();
            $modelmaloaihh = DmLoaiHh::all();
            $modelhh = DmHhTn::where('theodoi','Có')->get();
            return view('manage.giahhdv.hhdvtn.search.create')
                ->with('modelmaloaigia',$modelmaloaigia)
                ->with('modelmaloaihh',$modelmaloaihh)
                ->with('modelhh',$modelhh)
                ->with('pageTitle','Tìm kiếm thông tin giá hàng hóa trong nước');
        }else
            return view('errors.notlogin');
    }

    public function viewsearch(Request $request){
        if(Session::has('admin')){

            $_sql="select hsgiahhtn.*,
                          giahhtn.mahh,giahhtn.masopnhom,giahhtn.giatu,giahhtn.giaden,giahhtn.soluong,giahhtn.nguontin
                                        from hsgiahhtn, giahhtn
                                        Where hsgiahhtn.mahs=giahhtn.mahs";
            $input=$request->all();

            //Thời gian nhập
            //Từ
            if($input['tgnhaptu']!=null){
                $_sql=$_sql." and hsgiahhtn.tgnhap >='".date('Y-m-d',strtotime($input['tgnhaptu']))."'";
            }
            //Đến
            if($input['tgnhapden']!=null){
                $_sql=$_sql." and hsgiahhtn.tgnhap <='".date('Y-m-d',strtotime($input['tgnhapden']))."'";
            }
            //Loại giá(error Không biết vì sao)
            //$_sql=$input['maloaigia']!=null? $_sql." and hsgiahhtn.maloaigia = ".$input['maloaigia']:$_sql;
            //Loại hàng hóa(error Không biết vì sao)
            //$_sql=$input['maloaihh']!=null? $_sql." and hsgiahhtn.maloaihh = ".$input['maloaihh']:$_sql;
            //Tên hàng hóa
            $_sql=$input['mahh']!=null? $_sql." and giahhtn.mahh = ".$input['mahh']:$_sql;
            //Giá trị tài sản
            //Từ
            if(getDouble($input['giatritu'])>0)
                $_sql=$_sql." and giahhtn.giatu >= ".getDouble($input['giatritu']);
            //Đến
            if(getDouble($input['giatriden'])>0)
                $_sql=$_sql." and giahhtn.giaden <= ".getDouble($input['giatriden']);

            $model =  DB::select(DB::raw($_sql));
            //dd($model);

            $modeldm = DmHhTn::all();
            $modelpb = TtPhongBan::all();

            foreach($model as $tthh){
                $this->gettenhh($modeldm,$tthh);
                $this->getTtPhongBan($modelpb,$tthh);
            }

            return view('manage.giahhdv.hhdvtn.search.index')
                ->with('model',$model)
                ->with('pageTitle','Thông tin giá hàng hóa trong nước');
        }else
            return view('errors.notlogin');
    }


}
