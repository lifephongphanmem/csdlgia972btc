<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DiaBanHd;
use App\District;
use App\KkGDvLt;
use App\KkGDvLtCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CbKkGDvLtController extends Controller
{
    public function index(Request $request){
        $inputs = $request->all();
        $inputs['loaihang'] = isset($inputs['loaihang']) ? $inputs['loaihang'] : '3';
        $inputs['district'] = isset($inputs['district']) ? $inputs['district'] : 'all';
        $inputs['town'] = isset($inputs['town']) ? $inputs['town'] : 'all';
        $districts = DiaBanHd::where('level','H')
            ->get();
        $towns = DiaBanHd::where('level','X');
        $model = CsKdDvLt::where('loaihang',$inputs['loaihang']);

        if($inputs['district'] != 'all'){
            $model = $model->where('district',$inputs['district']);
            $towns = $towns->where('district',$inputs['district']);
            if($inputs['town'] != 'all')
                $model = $model->where('town',$inputs['town']);
        }
        $model = $model->get();
        $towns = $towns->get();

        return view('congbo.dvlt.index')
            ->with('model',$model)
            ->with('districts',$districts)
            ->with('towns',$towns)
            ->with('xa',$inputs['town'])
            ->with('huyen',$inputs['district'])
            ->with('loaihang',$inputs['loaihang'])
            ->with('pageTitle','Thông tin cơ sở kinh doanh kê khai dịch vụ lưu trú');
    }

    public function show($macskd){
        $modelcskd = CsKdDvLt::where('macskd',$macskd)
            ->first();
        $modelcq = District::where('mahuyen',$modelcskd->mahuyen)->first();
        $modelcb = CbKkGDvLt::where('macskd',$macskd)
            ->first();
        if(count($modelcb))
            $modelcbct = KkGDvLtCt::where('mahs',$modelcb->mahs)
                ->get();
        else
            $modelcbct = '';
        return view('congbo.dvlt.show')
            ->with('modelcskd',$modelcskd)
            ->with('modelcq',$modelcq)
            ->with('modelcb',$modelcb)
            ->with('modelcbct',$modelcbct)
            ->with('pageTitle','Thông tin kê khai dịch vụ');
    }

    public function history($macskd){
        $model = KkGDvLt::where('trangthai','Đã duyệt')
            ->where('macskd',$macskd)
            ->get();
        $modelcskd = CsKdDvLt::where('macskd',$macskd)->first();
        return view('congbo.dvlt.history')
            ->with('model',$model)
            ->with('modelcskd',$modelcskd)
            ->with('pageTitle','Thông tin kê khai giá');
    }

    public function showttkk(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $modelkk = KkGDvLt::where('id',$inputs['id'])
                ->first();
            $model = KkGDvLtCt::where('mahs',$modelkk->mahs)
                ->get();

            $result['message'] = '<div class="row" id="ttshow"> ';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover table-dulieubang"> ';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng<br> Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>cuối tuần</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';

            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr>';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'-'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.getTtPhong($ttphong->sohieu).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($ttphong->mucgiakk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($ttphong->mucgiakkct).'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '<p>'.nl2br(e($modelkk->ghichu)).'</p>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }
}
