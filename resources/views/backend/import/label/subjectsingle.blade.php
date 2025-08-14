@extends('backend.master')
@section('css')
<style>
    
  

        @media (max-width: 768px) {
            .sidebar {
              width: 10px;
    height: 100vh;
    background-color: #2f3542;
    color: #ffffff;
    padding: 20px;
    position: fixed;
    transition: width 0.3s;
    overflow-y: auto;
            }
            .main-content {
                width: 100%; /* Full width for container */
                    margin-left: -10px;
    padding: 20px;
    
            }
        }
  
}
</style>
@endsection
@section('content')

<h1>Questions List</h1>
<p>প্রথমটির যে টপিক এডড হয়। সব গুলোর সেটি হবে ।   <p>
<div class="container">
    <h1>
        @if ($topicStatus==1)
        <p>topic already add</p>
    @else
    <p>no topic add</p>
    @endif</h1>

    @if($questions->isNotEmpty())
        <form action="{{ route('admin.updateTopicsSingle') }}" method="POST">

            {{-- {{ route('updateTopics') }} --}}
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Question Title</th>
                        <th>Option Title</th>
                        <th>Select Topic</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions->groupBy('question_id') as $questionId => $groupedOptions)
                        @php
                            $firstOption = $groupedOptions->first();
                        @endphp
                        <tr>
                            <input  type="hidden" name="firstOption" value="{{$firstOption->question_id}}">
                            <td>{!! $firstOption->q_title !!}
                            <br>
                            <br>
                             @php
    // Ensure $firstOption->topic_id is an array
                             $topicIds = is_array($firstOption->topic_id) ? $firstOption->topic_id : explode(',', $firstOption->topic_id);
                            @endphp
                              
                              
                            <!--  @foreach ($topics as $topic)-->
                            <!--    &nbsp;&nbsp;<input type="checkbox" -->
                            <!--           name="topics[{{ $questionId }}]" -->
                            <!--           value="{{ $topic->id }}" -->
                            <!--           @if(in_array($topic->id, $topicIds)) checked @endif>-->
                                      
                            <!--    {{ $topic->t_title }}-->
                            <!--@endforeach-->
                            </td>
                            <td>{!! $groupedOptions->first()->p_title !!}{!! $groupedOptions->first()->is_correct !!}</td>
                            <td>
                                <select name="topics[{{ $questionId }}]" >
                                    <!-- <option value="">Select a topic</option> -->
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}"
                                          {{ in_array($topic->id, $topicIds) ? 'selected' : '' }}>
                                            {{ $topic->t_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                        </tr>
                        @foreach($groupedOptions->slice(1) as $option)
                            <tr>
                                <td></td>
                                <td>{!!$option->p_title !!} {!!$option->is_correct !!}</td>
                                <td></td> <!-- Empty cell to match the header layout -->
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <button type="submit">Save</button>
        </form>
    @else
        <p>No questions found.</p>
    @endif
</div>

@endsection
