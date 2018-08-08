<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use function Symfony\Component\HttpKernel\Tests\controller_func;
use Validator;
use App\Users;
use Hash;

class UserAuthController extends Controller
{
    //註冊頁
    public function signUpPage(){
        $binding = [
          'title' => 'Register',
        ];
        return view('signUp', $binding);
    }

    public function signUpProcess(){
        $input = request()->all();

        $rules = [
          'nickname' => [
              'required',
              'max:50'
          ],
           'email' => [
               'required',
               'max:150',
               'email'
           ],
            'password' => [
                'required',
                'same:password_confirmation',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/'
            ],
            'password_confirmation' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/'
            ],
            'type' => [
                'in:G,A'
            ]
        ];
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return redirect(route('registerPage'))->withErrors($validator)->withInput();
        }

        $chk = Users::where('nickname', $input['nickname'])->first();
        if($chk){
            return redirect(route('registerPage'))->withErrors("nickname is existed!")->withInput();
        }

        $input['password'] = Hash::make($input['password']);
        Users::create($input);

        $mail_binding = [
            'nickname' => $input['nickname']
        ];
        Mail::send('signUpEmailNotification', $mail_binding, function($mail) use ($input){
            $mail -> to($input['email']);
            $mail -> from('apple80177@gmail.com');
            $mail -> subject('恭喜註冊成功！！');
        });

        return redirect(route('loginPage'));
    }

    public function signInPage(){
        $binding = [
            'title' => 'Login',
        ];
        return view('signIn', $binding);
    }

    public function signInProcess(){
        $input = request()->all();

        $rules = [
            'email' => [
                'required',
                'max:150',
                'email'
            ],
            'password' => [
                'required',
                'min:6'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return redirect(route('loginPage'))->withErrors($validator)->withInput();
        }

        $User = Users::where('email', $input['email']) -> firstOrFail();

        $is_password_correct = Hash::check($input['password'], $User->password);
        if(!$is_password_correct){
            $error_msg = [
                'msg' => '密碼錯誤！'
            ];
            return redirect(route('loginPage'))->withErrors($error_msg)->withInput();
        }

        session()->put('user_id', $User->id);
        return redirect()->intended('merchandise/');
    }

    public function signOut(){
        session()->forget('user_id');
        return redirect('/merchandise/');
    }
}