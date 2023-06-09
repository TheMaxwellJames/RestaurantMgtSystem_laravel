<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Foodchef;
use App\Models\Order;

class AdminController extends Controller
{
    public function user()
    {
        $data=User::all();


        return view("admin.users", compact('data'));
    }


    public function deleteuser($id)
    {

        $data=User::find($id);

        $data->delete();

        return redirect()->back();

    }





    public function foodmenu()
    {
        $data = food::all();



        return view('admin.foodmenu', compact('data'));
    }







    public function upload(Request $request)
    {

        $data = new food;

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('foodimage', $imagename);

        $data->image= $imagename;

        $data->title = $request->title;

        $data->price = $request->price;

        $data->description = $request->description;

        $data->save();

        return redirect()->back();


       
    }




    public function deletemenu($id)
    {
        $data=food::find($id);

        $data->delete();

        return redirect()->back();
    }




    public function updateview($id)
    {
        $data=food::find($id);

        return view("admin.updateview", compact('data'));
    }







    public function update(Request $request, $id)
    {
        $data=food::find($id);


        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('foodimage', $imagename);

        $data->image= $imagename;

        $data->title = $request->title;

        $data->price = $request->price;

        $data->description = $request->description;

        $data->save();

        return redirect()->back();


    }



    public function reservation(Request $request)
    {
        $data = new reservation;

      
        $data->name = $request->name;

        $data->email = $request->email;

        $data->phone = $request->phone;

        $data->guest = $request->guest;

        $data->date = $request->date;

        $data->time = $request->time;

        $data->message = $request->message;

        $data->save();

        return redirect()->back();
    }




    public function viewreservation()
    {


        if(Auth::id())
        {

       

        $data=reservation::all();


        return view('admin.adminreservation', compact('data'));

    }

    else
    {
        return redirect('login');
    }


    }




    public function viewchef()
{

    if(Auth::id())
    {
        $data = Foodchef::all();


        return view('admin.adminchef', compact('data'));
    }

    else
    {
        return redirect('login');
    }

 
}



public function uploadchef(Request $request)
{
        $data = new foodchef;

        $image = $request->image;


        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('chefimage', $imagename);

        $data->image= $imagename;

        $data->name=$request->name;

        $data->specialty=$request->specialty;


        $data->save();

        return redirect()->back();
}



public function updatechef($id)
{
    $data=foodchef::find($id);

    return view('admin.updatechef', compact('data'));
}




public function updatefoodchef(Request $request, $id)
{


    $data=foodchef::find($id);



    $image=$request->image;

    if($image)
    {

    
    $imagename=time().'.'.$image->getClientOriginalExtension();

    $request->image->move('chefimage', $imagename);

    $data->image= $imagename;

}

    $data->name = $request->name;

    $data->specialty = $request->specialty;

   

    $data->save();

    return redirect()->back();




}



public function deletechef($id)
{

    if(Auth::id())
    {
      


    $data=foodchef::find($id);


    $data->delete();


    return redirect()->back();

}

else
{
    return redirect('login');
}


}




public function orders()
{

    if(Auth::id())
    {
        $data=order::all();

        return view('admin.orders', compact('data'));
    }

    else
    {
        return redirect('login');
    }

  
}






public function search(Request $request)
{
    $search = $request->search;

    $data = order::where('name', 'LIKE', '%' . $search . '%')->orWhere('foodname', 'LIKE', '%' . $search . '%')
    ->get();

    return view('admin.orders', compact('data'));
}














}
