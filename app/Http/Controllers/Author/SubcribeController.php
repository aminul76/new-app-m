<?php

namespace App\Http\Controllers\Author;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\CourseSubscribe;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SubcribeController extends Controller
{
    public function subcribe($id)
    {
      
        $course = Course::find($id);
       
        return view('user.subcribe.subcribe', ['course' => $course,]);
 
    }

    public function tnxid($id)
    {
      
        $course = Course::find($id);
       
        return view('user.subcribe.tnxid', ['course' => $course,]);
 
    }

    public function payment(Request $request)
    {
        // Validate input
   
        $user = Auth::user();
        $alradyuser=0;
        $validated = $request->validate([
            'mobile_number' => 'required|numeric',
            'transaction_id' => 'required|string|max:255',
            'course_id' => 'numeric',
        ]);

        $random_number =rand(123456, 999999);
        $course = Course::find($validated['course_id']);



        if ($user) {
        $subscription =CourseSubscribe::where('user_id', $user->id)
        ->where('course_id',$validated['course_id'])
        ->first();
        if ($subscription){
            $already=1;
            return view('user.subcribe.thanks',['course' => $course,'already'=>$already,]);
        }
        }
        else{
            $alradyuser=User::where('email', $request->email)->first();
            if ($alradyuser!=null) {
                $subscription =CourseSubscribe::where('user_id', $alradyuser->id)
                ->where('course_id',$validated['course_id'])
                ->first();
                if ($subscription){
                    $already=1;
                    return view('user.subcribe.thanks',['course' => $course,'already'=>$already,]);
                } 
             }else {
                $user=User::create([
                   'name' => $random_number,    
                   'email' => $request->email,                 
                   'password' => Hash::make($random_number),
               ]);
            
        }

    }
       
        // Save data to the database
        $payment = new CourseSubscribe();
        $payment->mobile_number = $validated['mobile_number'];
        $payment->transaction_id = $validated['transaction_id'];

        $payment->course_id = $validated['course_id'];
        if ($alradyuser!=null) {
            $payment->user_id=$alradyuser->id;
         }
         else {
         $payment->user_id= $user->id;
         }
        
        $payment->subscribed_at = now();
        $payment->expires_at = Carbon::now()->subDay();

        $payment->save();

        $already=0;

        // Redirect or return a response
        return view('user.subcribe.thanks',['course' => $course,'already'=>$already,]);
    }





}
