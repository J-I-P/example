<?php

namespace App\Http\Controllers\Merchandise;

use App\Transaction;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchandises;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Validator;
use Image;

class MerchandiseController extends Controller
{
    //
    public function merchandiseListPage(){
        $row_per_page = 10;
        $MerchandisePaginate = Merchandises::OrderBy('update_at', 'desc')->where('status', 'S')->paginate($row_per_page);

        foreach ($MerchandisePaginate as $Merchandise){
            if(!is_null($Merchandise->photo)){
                $Merchandise->photo = url($Merchandise->photo);
            }
        }

        $binding = [
            'title' => '商品列表',
            'MerchandisePaginate' => $MerchandisePaginate
        ];

        return view('listMerchandise', $binding);
    }

    public function merchandiseManageListPage(){
        $row_per_page = 10;
        $MerchandisePaginate = Merchandises::OrderBy('created_at', 'desc')->paginate($row_per_page);
        foreach ($MerchandisePaginate as $Merchandise){
            if(!is_null($Merchandise->photo)){
                $Merchandise->photo = url($Merchandise->photo);
            }
        }

        $binding = [
            'title' => '管理商品',
            'MerchandisePaginate' => $MerchandisePaginate
        ];

        return view('manageMerchandise', $binding);
    }

    public function merchandiseCreateProcess(){
        $merchandise_data = [
            'status' => 'C',
            'name' => '',
            'name_en' => '',
            'introduction' => '',
            'introduction_en' => '',
            'photo' => null,
            'price' => 0,
            'remain_count' => 0
        ];
        $Merchandise = Merchandises::create($merchandise_data);
        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    public function merchandiseItemPage($merchandise_id){
        $Merchandise = Merchandises::findOrFail($merchandise_id);

        if (!is_null($Merchandise->photo)){
            $Merchandise->photo = url($Merchandise->photo);
        }

        $binding = [
            'title' => '商品頁',
            'Merchandise' => $Merchandise
        ];

        return view('showMerchandise', $binding);
    }

    public function merchandiseItemEditPage($merchandise_id){
        $Merchandise = Merchandises::findOrFail($merchandise_id);

        if (!is_null($Merchandise->photo)){
            $Merchandise->photo = url($Merchandise->photo);
        }

        $binding = [
            'title' => '編輯商品',
            'Merchandise' => $Merchandise
        ];

        return view('editMerchandise', $binding);
    }

    public function merchandiseItemUpdateProcess($merchandise_id){
        $Merchandise = Merchandises::findOrFail($merchandise_id);
        $input = request()->all();

        $rules = [
            'status' => [
                'required',
                'in:C,S'
            ],
            'name' => [
                'required',
                'max:80'
            ],
            'name_en' => [
                'required',
                'max:80'
            ],
            'introduction' => [
                'required',
                'max:2000'
            ],
            'introduction_en' => [
                'required',
                'max:2000'
            ],
            'photo' => [
                'file',
                'image',
                'max: 10240'
            ],
            'price' => [
                'required',
                'integer',
                'min:0'
            ],
            'remain_count' => [
                'required',
                'integer',
                'min:0'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return redirect('/merchandise/' . $Merchandise->id . '/edit')->withErrors($validator)->withInput();
        }

        if (isset($input['photo'])){
            $photo = $input['photo'];
            $file_extension = $photo->getClientOriginalExtension();
            $file_name = uniqid() . '.' . $file_extension;
            $file_relative_path = 'images/merchandise/' . $file_name;
            $file_path = public_path($file_relative_path);
            $image = Image::make($photo)->fit(450, 300)->save($file_path);
            $input['photo'] = $file_relative_path;
        }

        $Merchandise->update($input);
        return redirect('/merchandise/manage');
    }

    public function merchandiseItemBuyProcess($merchandise_id){
        $input = request()->all();

        $rules = [
            'buy_count' => [
                'required',
                'integer',
                'min:1'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return redirect('/merchandise/' . $merchandise_id)->withErrors($validator)->withInput();
        }

        try{
            $user_id = session()->get('user_id');
            $User = Users::findOrFail($user_id);

            DB::beginTransaction();
            $Merchandise = Merchandises::findOrFail($merchandise_id);
            $buy_count = $input['buy_count'];
            $remain_count_after_buy = $Merchandise->remain_count - $buy_count;
            if ($remain_count_after_buy < 0){
                throw new Exception('商品數量不足，無法購買！');
            }

            $Merchandise->remain_count = $remain_count_after_buy;
            $Merchandise->save();

            $total_price = $buy_count * $Merchandise->price;

            $transaction_data = [
                'user_id' => $User->id,
                'merchandise_id' => $Merchandise->id,
                'price' => $Merchandise->price,
                'buy_count' => $buy_count,
                'total_price' => $total_price
            ];

            Transaction::create($transaction_data);
            DB::commit();

            $message =[
                'msg' => [
                    '購買成功～'
                ]
            ];

            return redirect()->to('/merchandise/' . $Merchandise->id)->withErrors($message);
        }catch (Exception $exception){
            DB::rollBack();

            $error_message = [
                'msg' => [
                    $exception->getMessage()
                ]
            ];
            return redirect()->back()->withErrors($error_message)->withInput();
        }
    }
}
