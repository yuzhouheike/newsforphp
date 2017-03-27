@extends('admin.layout')

@section('cssheader')
<link href="{{ asset('css/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop


@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Channel Manager</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>频道名称</th>
                                    <th>默认名称</th>
                                    <th>是否显示(客户端)</th>
                                    <th>最近编辑</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($channel as $c)
                                <tr class="odd gradeX">
                                    <td>{{$c->catagory}}</td>
                                    <td>{{$c->defaultname}}</td>
                                    <td>{{$c->isshow == 1 ? "显示":"隐藏" }}</td>
                                    <td class="center">{{ date("Y-m-d H:i:s",$c->eidttime) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

</div>




@stop


@section('scriptfooter')
<script src="{{ asset('css/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('css/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>
<script>
     $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

</script>
@stop