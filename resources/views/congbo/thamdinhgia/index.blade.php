@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script-cb')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        $(function(){
            $('#nambc').change(function() {
                var nambc = $('#nambc').val();
                var ttpb = $('#ttpb').val();
                var url = '/thamdg?nam='+nambc+'&pb='+ttpb;
                window.location.href = url;
            });
            $('#ttpb').change(function() {
                var nambc = $('#nambc').val();
                var ttpb = $('#ttpb').val();
                var url = '/thamdg?nam='+nambc+'&pb='+ttpb;
                window.location.href = url;
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject theme-font bold uppercase">thông tin hồ sơ thẩm định giá</span>
                        </div>
                        <div class="actions">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="nambc" id="nambc" class="form-control">
                                        @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                        @if ($nam_stop = intval(date('Y'))) @endif
                                        @for($i = $nam_start; $i <= $nam_stop; $i++)
                                            <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2me" id="ttpb" name="ttpb">
                                        <option value="all">--Tất cả phòng ban--</option>
                                        @foreach($modelpb as $ttpb)
                                            <option value="{{$ttpb->mahuyen}}" {{($inputs['pb'] == $ttpb->mahuyen) ? 'selected' : ''}}>{{$ttpb->tendv}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th width="2%" style="text-align: center">STT</th>
                                <th style="text-align: center" width="20%">Tên đơn vị</th>
                                <th style="text-align: center">Số hồ sơ</th>
                                <th style="text-align: center">Số thông báo<br>kết luận</th>
                                <th style="text-align: center">Thời điểm <br>thẩm định</th>
                                <th style="text-align: center">Nguồn vốn</th>
                                <th style="text-align: center">Thuế VAT</th>
                                <th style="text-align: center">Thời hạn <br>thẩm định</th>
                                <th style="text-align: center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td class="active">{{$tt->tenpb}}</td>
                                    <td style="text-align: center">{{$tt->hosotdgia}}</td>
                                    <td style="text-align: center">{{$tt->sotbkl}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td style="text-align: center">{{$tt->nguonvon}}</td>
                                    <td>{{$tt->thuevat}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoihan)}}</td>

                                    <td>
                                        <a href="{{url('thamdg/detail?mahs='.$tt->mahs)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem thông tin </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
@stop 