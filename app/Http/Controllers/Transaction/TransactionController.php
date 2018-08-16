<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    //
    public function transactionListPage(){
        $user_id = session()->get('user_id');

        $row_per_page = 10;
        $TransactionPaginate = Transaction::where('user_id', $user_id)->OrderBy('created_at', 'desc')->with('Merchandise')->paginate($row_per_page);

        foreach ($TransactionPaginate as $Transaction){
            if (!is_null($Transaction->Merchandise->photo)){
                $Transaction->Merchandise->photo = url($Transaction->Merchandise->photo);
            }
        }

        $binding = [
            'title' => '交易紀錄',
            'TransactionPaginate' => $TransactionPaginate
        ];

        return view('listUserTransaction', $binding);
    }
}
