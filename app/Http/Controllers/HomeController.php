<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Food;

use App\Models\Foodchef;

use App\Models\Cart;



class HomeController extends Controller
{
    public function index()
    {

        $data=food::all();

        $data2=foodchef::all();
       

        
        

     
        return view("home", compact("data", "data2"));
    }


    
    public function redirects()
    {

        $data=Food::all();
        $data2=Foodchef::all();

        $usertype = Auth::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.adminhome');
        }

        else
        {

            $user_id=Auth::id();

            $count=cart::where('user_id', $user_id)->count();


            return view('home', compact("data", "data2", "count"));
        }
    }





    public function addcart(Request $request, $id)
    {


        if(Auth::id())
        {

            $user_id=Auth::id();

            $food_id=$id;

            $quantity=$request->quantity;

            $cart=new cart;

            $cart->user_id = $user_id;

            $cart->food_id = $food_id;

            $cart->quantity = $quantity;

            $cart->save();

         

            return redirect()->back();
        }
        else
        {

            return redirect('/login');
        }


    }



    public function showcart(Request $request, $id)
    {

        $count=cart::where('user_id', $id)->count();

        $data2=cart::select('*')->where('user_id', '=', $id)->get();

        $data=cart::where('user_id', $id)->join('food', 'carts.food_id', '=' , 'food.id')->get();


            return view('showcart', compact('count', 'data', 'data2'));


    }




    public function remove($id)
    {
        $data=cart::find($id);

        $data->delete();


        return redirect()->back();
    }

}
