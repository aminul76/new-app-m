@extends('backend.master')

@section('content')
    <h1>Model Tests</h1>
    <a href="{{ route('admin.model_tests.create') }}">Create New Model Test</a>


    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>

                <th>Title</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modelTests as $modelTest)
                <tr>
                    <td>{{ $modelTest->id }}</td>
                    <td>{{ $modelTest->title }}</td>
                    {{-- <td>{{ $modelTest->p_title }}</td> --}}
                    <td>{{ $modelTest->course->c_title }}</td>
                    <td>
                        <a href="{{ route('admin.model-test.add-questions.form',$modelTest->id) }}">Add Question</a>
                <a href="{{ route('admin.model_tests.edit', $modelTest->id) }}">Edit</a>
                <form action="{{ route('admin.model_tests.destroy', $modelTest->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
