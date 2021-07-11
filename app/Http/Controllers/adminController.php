<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use App\Models\Payments;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(Request $req)
    {
        $this->validate($req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            ]
        );
        $credentials = array('email' => $req->email, 'password' => $req->password);

        if (Auth::attempt($credentials)) {
            return redirect('/admin/confirm')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'thongbao' => 'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
    public function getConfirm()
    {
        $customer = Customer::all();
        $bill = Bill::all();
        $bill_details = BillDetail::all();
        $products = Products::all();
        return view('admin.confirm', ['customer' => $customer, 'bill' => $bill, 'bill_details' => $bill_details, 'products' => $products]);
    }
    public function getDelivery()
    {
        $customer = Customer::all();
        $bill = Bill::all();
        $bill_details = BillDetail::all();
        $products = Products::all();
        return view('admin.delivery', ['customer' => $customer, 'bill' => $bill, 'bill_details' => $bill_details, 'products' => $products]);
    }
    public function getComplete()
    {
        $customer = Customer::all();
        $bill = Bill::all();
        $bill_details = BillDetail::all();
        $products = Products::all();
        return view('admin.complete', ['customer' => $customer, 'bill' => $bill, 'bill_details' => $bill_details, 'products' => $products]);
    }
    public function getPayments()
    {
        $payments = Payments::all();
        return view('admin.payments', ['payments' => $payments]);
    }
    public function getDelete()
    {
        $customer = Customer::all();
        $bill = Bill::all();
        $bill_details = BillDetail::all();
        $products = Products::all();
        return view('admin.delete', ['customer' => $customer, 'bill' => $bill, 'bill_details' => $bill_details, 'products' => $products]);
    }

    public function postConfirm(Request $request)
    {
        $bill_up = Bill::find($request->id);
        $bill_up->status = 2;
        $bill_up->save();

        return redirect()->back();
    }
    public function postDelivery(Request $request)
    {
        $bill_up = Bill::find($request->id);
        $bill_up->status = 3;
        $bill_up->save();

        return redirect()->back();
    }
    public function postDelete(Request $request)
    {
        $bill_up = Bill::find($request->id);
        $bill_up->status = 0;
        $bill_up->save();

        return redirect()->back();
    }
}
