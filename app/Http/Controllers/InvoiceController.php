<?php

namespace App\Http\Controllers;

use App\Models\OrderBillingDetails;
use App\Models\OrderProductsDetails;
use LaravelDaily\Invoices\Invoice;


class InvoiceController extends Controller
{
    function invoice($id)
    {
        $data = OrderProductsDetails::whereOrderId($id)->get();
        $cus = OrderBillingDetails::whereOrderId($id)->first();


        $customer = Invoice::makeParty([
            'name' => $cus->customer_name,
            'phone' => $cus->phone_number

        ]);
        $items = [];
        foreach ($data as $item) {
            $i = Invoice::makeItem($item->product_name)->pricePerUnit($item->product->product_price)->quantity($item->product_quantity);
            array_push($items, $i);
        }
        return Invoice::make()->buyer($customer)->addItems($items)->payUntilDays(0)->currencyFormat('{VALUE} BDT')->stream();


    }
}
