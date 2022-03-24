<?php

namespace App\Http\Controllers;

use App\Models\expence;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Middleware\shield;

class ExpenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = expence::whereDate('created_at', date('Y-m-d'))->get();
        $sum = $data->sum('amount');
        if(request()->session()->has('alert'))
        return Inertia('Expense', ['name'=>$data, 'sum'=>$sum, 'alert'=>request()->session()->get('alert')]);
        else
        return Inertia('Expense', ['name'=>$data, 'sum'=>$sum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = $this->getdata()['cat'];
        $paymths = $this->getdata()['paymth'];
        if(request()->session()->get('model'))
        {
            request()->session()->forget('model');
            return Inertia('Addexpense', ['cats'=>$cats,'paymths'=>$paymths, 'model'=> "on"]);
        }
        else
            return Inertia('Addexpense', ['cats'=>$cats,'paymths'=>$paymths]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = $this->getdata()['cat'];
        $paymth = $this->getdata()['paymth'];
        $check = $this->validate($request,[
            "description" => ["required"],
            "amount" => ['required'],
            "category" => ['required', Rule::in($cat)],
            "payment_method" => ['required', Rule::in($paymth)]
        ]);
        $add = new expence();
        $add->description = $request->description;
        $add->amount = $request->amount;
        $add->category = $request->category;
        $add->user_id = ($request->session()->get('user'))->id;
        $add->payment_method = $request->payment_method;
        $add->save();
        return redirect('/addexpense')->with('model', 'on');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, expence $expence)
    {
        
        if($request->category || $request->payment_method || $request->month || $request->day)
        {
            if($request->category && $request->payment_method && $request->month && $request->day)
            {
                $cat = $request->category;
                $paymths = $request->payment_method;
                $month =  $request->month;
                $date = explode("-",$request->day);
                $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->whereYear('created_at',$date[0])->whereMonth('created_at',$date[1])->whereDay('created_at',$date[2])->get();
                $sum =  $data->sum('amount');
            
            }
            else if($request->category && $request->payment_method && $request->day)
            {
                $cat = $request->category;
                $paymths = $request->payment_method;
                $date = explode("-",$request->day);
                $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->whereDay('created_at',$date[2])->get();
                $sum =  $data->sum('amount');
        
            }
            else if($request->category && $request->payment_method && $request->month)
            {
                $cat = $request->category;
                $paymths = $request->payment_method;
                $month =  explode("-",$request->month);
                $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->whereYear('created_at',$month[0])->whereMonth('created_at',$month[1])->get();
                $sum =  $data->sum('amount');

            }
            else if($request->category && $request->month && $request->day)
            {
                $cat = $request->category;
                $month =  $request->month;
                $date = explode("-",$request->day);
                $data = expence::where('category','=',$cat)->whereYear('created_at',$date[0])->whereMonth('created_at',$date[1])->whereDay('created_at',$date[2])->get();
                $sum =  $data->sum('amount');

            }
            else if($request->month && $request->day)
            {
                $month =  $request->month;
                $date = explode("-",$request->day);
                $data = expence::whereYear('created_at',$date[0])->whereMonth('created_at',$date[1])->whereDay('created_at',$date[2])->get();
                $sum =  $data->sum('amount');

            }
            else if($request->category && $request->payment_method)
            {
                $cat = $request->category;
                $paymths = $request->payment_method;
                $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->get();
                $sum =  $data->sum('amount');


            }
            else if($request->month)
            {
                $month = explode("-",$request->month);
                $data = expence::whereYear('created_at',$month[0])->whereMonth('created_at',$month[1])->get();
                $sum =  $data->sum('amount');
            }
        }
        else
        {
            $data = $expence::all();
            $sum =  $data->sum('amount');


        }
        $cats = $this->getdata()['cat'];
        $paymths = $this->getdata()['paymth'];
       
        return Inertia('View', ['data'=>$data, 'cats'=>$cats,'pays'=>$paymths, 'sum'=>$sum]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function edit(expence $expence)
    {
        $cats = $this->getdata()['cat'];
        $paymths = $this->getdata()['paymth'];
        $edit = $expence::find(request()->id);
        return Inertia('Update', ['data'=>$edit,'cats'=>$cats,'paymths'=>$paymths]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expence $expence)
    {
        $update = $expence::find($request->id);
        $update->description = $request->description;
        $update->amount = $request->amount;
        $update->category = $request->category;
        $update->payment_method = $request->payment_method;
        $update->save();
        $data = expence::all();
        return redirect('home')->with('alert','Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expence  $expence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, expence $expence)
    {
        $del = $expence::find($request->id);
        $del->delete();
        return redirect('home')->with('alert','Successfully Deleted');
    }

    public function filter(Request $request)
    {
       
        if($request->category && $request->payment_method && $request->month && $request->day)
        {
            $cat = $request->category;
            $paymths = $request->payment_method;
            $month =  $request->month;
            $date = explode("-",$request->day);
            $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->whereYear('created_at',$date[0])->whereMonth('created_at',$date[1])->whereDay('created_at',$date[2])->get();
        }
        else if($request->category && $request->payment_method && $request->day)
        {
            $cat = $request->category;
            $paymths = $request->payment_method;
            $date = explode("-",$request->day);
            $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->whereDay('created_at',$date[2])->get();
        }
        else if($request->category && $request->payment_method && $request->month)
        {
            $cat = $request->category;
            $paymths = $request->payment_method;
            $month =  explode("-",$request->month);
            $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->whereYear('created_at',$month[0])->whereMonth('created_at',$month[1])->get();

        }
        else if($request->category && $request->month && $request->day)
        {
            $cat = $request->category;
            $month =  $request->month;
            $date = explode("-",$request->day);
            $data = expence::where('category','=',$cat)->whereYear('created_at',$date[0])->whereMonth('created_at',$date[1])->whereDay('created_at',$date[2])->get();

        }
        else if($request->month && $request->day)
        {
            $month =  $request->month;
            $date = explode("-",$request->day);
            $data = expence::whereYear('created_at',$date[0])->whereMonth('created_at',$date[1])->whereDay('created_at',$date[2])->get();

        }
         else if($request->category && $request->payment_method)
        {
            $cat = $request->category;
            $paymths = $request->payment_method;
            $data = expence::where('category','=',$cat)->where('payment_method','=',$paymths)->get();

        }
        else if($request->month)
        {
            $month = explode("-",$request->month);
            $data = expence::whereYear('created_at',$month[0])->whereMonth('created_at',$month[1])->get();
        }

        $cats = $this->getdata()['cat'];
        $paymths = $this->getdata()['paymth'];
        return Inertia('View', ['data'=>$data, 'cats'=>$cats,'pays'=>$paymths]);
        

    }

    public function getdata()
    {
        return [
        "cat" => ['food','travel','lend','home','recharge','snack'],
        "paymth" => ['Cash', 'PhonePay', 'Gpay','AmazonPay']
        ];
    }
}
