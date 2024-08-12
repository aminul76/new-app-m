@extends('backend.master')

@section('content')

<h1>Questions List</h1>

<div class="container">
    <h1>Questions and Options</h1>

    @if($questions->isNotEmpty())
        <form action="{{ route('admin.updateTopics') }}" method="POST">

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
                            <td>{{ $firstOption->q_title }}</td>
                            <td>{{ $groupedOptions->first()->p_title }}</td>
                            <td>
                                <select name="topics[{{ $questionId }}]" required>
                                    <option value="">Select a topic</option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}"
                                            {{ old("topics.$questionId") == $topic->id ? 'selected' : '' }}>
                                            {{ $topic->t_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                        </tr>
                        @foreach($groupedOptions->slice(1) as $option)
                            <tr>
                                <td></td>
                                <td>{{ $option->p_title }}</td>
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
