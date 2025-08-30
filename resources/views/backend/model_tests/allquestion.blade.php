@extends('backend.master')

@section('content')
    <h1>Model Test Question</h1>
  
পরিক্ষা কেউ দিলে তারপর প্রশ্ন ডিলেট করলে ইরোর দিতে পারে।

    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>

                <th>Title</th>
              
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allquestions as $allquestion)
                <tr>
                    <td>{{ $allquestion->id }}</td>
                    <td>{!!$allquestion->question->q_title !!}</td>
                  <td>
                <form action="{{ route('admin.dquestions.destroy', $allquestion->id) }}" method="POST" style="display:inline;"onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>

                    <script>
                    function confirmDelete() {
                        return confirm('Are you sure you want to delete this video?');
                    }
                    </script>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
