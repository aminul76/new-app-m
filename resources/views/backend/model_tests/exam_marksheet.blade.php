@extends('backend.master')

@section('content')
    <h1>Model Tests</h1>
    <a href="{{ route('admin.model_tests.create') }}">Create New Model Test</a>

  


  @if($mergedRecords->count())
    <table id="dTable" class="display">
      <thead>
                <tr>
                     <th>Number</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Correct</th>
                    <th>Incorrect</th>
                    <th>Mark</th>
                    <th>Score (%)</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach($mergedRecords as $record)
                    <tr>
                           <td>{{ $record->user_phone ?? 'N/A' }}</td>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->user->name ?? $record->user_name ?? 'N/A' }}</td>

                        @if(isset($record->correct_answers_count))
                            {{-- UserExamRecord --}}
                            <td>{{ $record->correct_answers_count }}</td>
                            <td>{{ $record->incorrect_answers_count }}</td>
                            <td>{{$record->correct_answers_count - $record->incorrect_answers_count*.25 }}</td>
                            <td>
                                @php
                                    $total = $record->modeltest_count;
                                    $correct = $record->correct_answers_count - $record->incorrect_answers_count*.25 ;;
                                    $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
                                @endphp
                                {{ $score }}%
                            </td>
                           
                        @else
                           
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No records found.</p>
    @endif


@endsection
