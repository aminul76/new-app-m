@extends('backend.master')

@section('content')
    <h1>Model Tests</h1>
    <a href="{{ route('admin.model_tests.create') }}">Create New Model Test</a>

  @if($records->count())
    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
              
                <th>Correct</th>
                <th>Incorrect</th>
                <th>Mark</th>
                <th>Score (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->user_name ?? 'N/A' }}</td>
                    
                    <td>{{ $record->correct_answers_count }}</td>
                    <td>{{ $record->incorrect_answers_count }}</td>
                    <td>{{$record->correct_answers_count - $record->incorrect_answers_count*.25 }}</td>
                    <td>
                        @php
                            $total = $record->modeltest_count;
                            $correct = $record->correct_answers_count - $record->incorrect_answers_count*.25 ;
                            $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
                        @endphp
                        {{ $score }}%
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 @else
        <p>No exam records found.</p>
    @endif


@endsection
