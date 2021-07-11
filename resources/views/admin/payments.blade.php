@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Order_id</th>
                            <th>Name</th>
                            <th>Money</th>
                            <th>Note</th>
                            <th>time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stt = 1;
                        @endphp
                        @foreach ($payments as $payment)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt++ }}</td>
                                <td>{{ $payment->order_id }}</td>
                                <td>{{ $payment->thanh_vien }}</td>
                                <td>{{ $payment->money }}</td>
                                <td>{{ $payment->note }}</td>
                                <td>{{ $payment->time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
    @endsection
