@extends('admin.master')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @if ($message = Session::get('message'))
                <h3 class="text-center text-success">{{ $message }}</h3>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Confirm
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Address</th>
                            <th>Payment</th>
                            <th>Details</th>
                            <th>Confirm</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stt = 1;
                            $user = '';
                        @endphp
                        @foreach ($bill as $bill_item)
                            @if ($bill_item->status == 1)
                                @for ($i = 0; $i < count($customer); $i++)
                                    @if ($customer[$i]->id == $bill_item->id_customer) @php
                                        $user = $customer[$i];
                                        break;
                                    @endphp @endif
                                @endfor
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $stt++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $bill_item->total }} VNĐ</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $bill_item->payment }}</td>
                                    <td class="center"><i class="fa fa-list-alt fa-fw"></i><a data-toggle="modal"
                                            data-target={{ '#myModal' . $bill_item->id }} href="#" }}>Details</a>
                                    </td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                            href="/admin/postConfirm?id={{ $bill_item->id }}">Confirm</a></td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                            href="/admin/postDelete?id={{ $bill_item->id }}">Delete</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @foreach ($bill as $bill_item)
                    <div class="modal fade" id={{ 'myModal' . $bill_item->id }} role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">
                                    <style>
                                        table,
                                        th,
                                        td {
                                            border: 1px solid black;
                                            border-collapse: collapse;
                                            padding: 5px 20px;
                                        }

                                        table {
                                            width: 100%;
                                        }

                                    </style>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $stt = 1;
                                                $product = '';
                                            @endphp
                                            @foreach ($bill_details as $bill_details_item)
                                                @if ($bill_details_item->id_bill == $bill_item->id)
                                                    @for ($i = 0; $i < count($products); $i++)
                                                        @if ($products[$i]->id ==
                                                        $bill_details_item->id_product) @php
                                                            $product = $products[$i];
                                                            break;
                                                        @endphp @endif
                                                    @endfor
                                                    <tr>
                                                        <td>{{ $stt++ }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td><img src=".././image/product/{{ $product->image }}" alt=""
                                                                height="50px">
                                                        </td>
                                                        <td>{{ $bill_details_item->quantity }}</td>
                                                        <td>{{ $bill_details_item->unit_price }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
