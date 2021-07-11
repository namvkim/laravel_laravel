<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Payments;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }
    public function addManyToCart(Request $request, $id)
    {
        $product = Products::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addMany($product, $id, $request->qty);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }
    public function getCheckout()
    {
        return view('checkout');
    }
    public function postCheckout(Request $request)
    {
        if ($request->input('payment_method') != "VNPAY") {
            $cart = Session::get('cart');
            $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->gender = $request->input('gender');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone_number');
            $customer->note = $request->input('notes');
            $customer->save();

            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->input('payment_method');
            $bill->note = $request->input('notes');
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail->save();
            }
            Session::forget('cart');
            return redirect()->back()->with('success', 'Đặt hàng thành công aa');

        } else { //nếu thanh toán là vnpay

            $cart = Session::get('cart');

            $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->gender = $request->input('gender');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone_number');
            $customer->note = $request->input('notes');
            $request->session()->put('customer', $customer);

            $bill = new Bill();
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->input('payment_method');
            $bill->note = $request->input('notes');
            $request->session()->put('bill', $bill);

            $bill_detail_arr = array();
            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail_arr[] = $bill_detail;
            }
            $request->session()->put('bill_detail', $bill_detail_arr);

            return view('admin.vnpay-index', compact('cart'));
        }
    }

    public function delCartItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }
    //xóa nhiều
    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
    public function createPayment(Request $request)
    {
        $cart = Session::get('cart');
        $vnp_TxnRef = $request->transaction_id; //Mã giao dịch. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_Amount = str_replace(',', '', $cart->totalPrice * 100);
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => route('vnpayReturn'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASHSECRECT')) {
            $vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT') .
                $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' .
                $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            $cart = Session::get('cart');

            //lay du lieu vnpay tra ve
            $vnpay_Data = $request->all();

            // insert du lieu don hang vao database
            $customer_s = Session::get('customer');
            $customer = new Customer();
            $customer->name = $customer_s->name;
            $customer->gender = $customer_s->gender;
            $customer->email = $customer_s->email;
            $customer->address = $customer_s->address;
            $customer->phone_number = $customer_s->phone_number;
            $customer->note = $customer_s->note;
            $customer->save();

            $bill_s = Session::get('bill');
            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = $bill_s->date_order;
            $bill->total = $bill_s->total;
            $bill->payment = $bill_s->payment;
            $bill->note = $bill_s->note;
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail->save();
            }

            Session::forget('cart');

            //insert du lieu vao bang payments
            $payment = new Payments();
            $payment->order_id = $bill->id;
            $payment->thanh_vien = $customer_s->name;
            $payment->money = $vnpay_Data['vnp_Amount'];
            $payment->note = $vnpay_Data['vnp_OrderInfo'];
            $payment->vnp_response_code = $vnpay_Data['vnp_ResponseCode'];
            $payment->code_vnpay = $vnpay_Data['vnp_TxnRef'];
            $payment->code_bank = $vnpay_Data['vnp_BankCode'];
            $payment->time = $vnpay_Data['vnp_PayDate'];
            $payment->save();

            //truyen inputData vao trang vnpay_return
            return view('admin.vnpay_return', compact('vnpay_Data'));
        }

    }
}
