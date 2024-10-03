    <!-- Subscription Section -->
    
    
  @php
    $user = Auth::user();
    use Carbon\Carbon;
    $subscription = \App\Models\CourseSubscribe::where('user_id', $user->id)
    ->where('course_id', $course->id)
    ->where(function ($query) {
        $query->whereNull('expires_at')
              ->orWhere('expires_at', '>=', Carbon::now());
    })
    ->first();
  @endphp
   
@if (!$subscription)
<div class="subscription-section">
    <h2 class="subscription-title">{{$course->c_title}} কোর্সে</h2>

    <a href="{{ url('author/subcribe/view',$course->id) }}" class="subscription-b-btn" >Enroll</a>
</div> 
@endif
   
    <!-- Subscription Section end -->