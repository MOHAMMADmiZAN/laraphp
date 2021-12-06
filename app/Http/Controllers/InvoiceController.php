<?php

namespace App\Http\Controllers;

use App\Mail\sendinvoice;
use App\Models\Order;
use App\Models\OrderBillingDetails;
use App\Models\OrderProductsDetails;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\Invoices\Invoice;


class InvoiceController extends Controller
{
    // laravel Invoice
    function invoice($id)
    {
        $data = OrderProductsDetails::whereOrderId($id)->get();
        $cus = OrderBillingDetails::whereOrderId($id)->first();
        $discount = Order::findOrFail($id)->discount;
        $customer = Invoice::makeParty([
            'name' => $cus->customer_name,
            'phone' => $cus->phone_number

        ]);
        $items = [];
        foreach ($data as $item) {
            $i = Invoice::makeItem($item->product_name)->pricePerUnit($item->product->product_price)->quantity($item->product_quantity);
            array_push($items, $i);

        }
        $invoice = Invoice::make('Test_invoice')
            ->buyer($customer)
            ->addItems($items)
            ->payUntilDays(0)
            ->currencyFormat('{VALUE} BDT')
            ->discountByPercent($discount)
            ->filename($customer->name . time() . '-' . $id);


        return $invoice->stream();


    }
}
