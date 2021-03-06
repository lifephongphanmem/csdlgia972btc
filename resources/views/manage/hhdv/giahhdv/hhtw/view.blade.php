@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin giá hàng hóa, dịch vụ <small>do TW quy định</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                        <div class="form-body">
                            <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Thời gian nhập<span class="require">*</span></label>
                                        <input type="date" id="tgnhap" name="tgnhap" class="form-control required" value="{{$model->tgnhap}}" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group has-error">
                                        <label class="control-label">Thị trường<span class="require">*</span></label>
                                        <input type="text" id="thitruong" name="thitruong" class="form-control required" value="{{$model->thitruong}}" readonly>
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Loại hàng hóa<span class="require">*</span></label>
                                        <select class="form-control" id="maloaihh" name="maloaihh">
                                            @foreach($loaihh as $hh)
                                                <option value="{{$hh->maloaihh}}" {{$hh->maloaihh==$model->maloaihh?'selected':''}}>{{$hh->tenloaihh}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--/row-->
                            <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                            <thead>
                                            <tr role="row" class="text-center">
                                                <th width="2%" rowspan="2">STT</th>
                                                <th rowspan="2">Mã số</th>
                                                <th rowspan="2">Tên hàng hóa, dịch vụ</th>
                                                <th rowspan="2">Đơn vị</br>tính</th>
                                                <th colspan="2" class="text-center">Giá liền kề</th>
                                                <th colspan="2" class="text-center">Giá kê khai</th>
                                                <th rowspan="2">Nguồn tin</th>
                                                <th rowspan="2">Ghi chú</th>
                                            </tr>
                                            <tr role="row" class="text-center">
                                                <th>Giá từ</th>
                                                <th>Giá đến</th>

                                                <th>Giá từ</th>
                                                <th>Giá đến</th>
                                            </tr>
                                            </thead>
                                            <tbody id="ttts">
                                            @if(isset($modeltthh))
                                                @foreach($modeltthh as $key=>$tt)
                                                    <tr>
                                                        <td style="text-align: center">{{$key +1}}</td>
                                                        <td>{{$tt->mahh}}</td>
                                                        <td class="active">{{$tt->tenhh}}</td>
                                                        <td style="text-align: center">{{$tt->dvt}}</td>
                                                        <td style="text-align: right">{{number_format($tt->giatulk)}}</td>
                                                        <td style="text-align: right">{{number_format($tt->giadenlk)}}</td>
                                                        <td style="text-align: right">{{number_format($tt->giatu)}}</td>
                                                        <td style="text-align: right">{{number_format($tt->giaden)}}</td>
                                                        <td>{{$tt->nguontin}}</td>
                                                        <td>{{$tt->gc}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td colspan="9" style="text-align: center">Chưa có thông tin</td>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <a href="{{url('thongtin-tw/index?thoidiem='.$model->mathoidiem.'&nam='.$model->nam.'&pb=all')}}" class="btn green"><i class="fa fa-mail-reply"></i>&nbsp;Quay lại</a>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@stop