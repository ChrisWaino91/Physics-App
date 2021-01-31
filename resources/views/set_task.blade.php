@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Set A Task</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <form method="POST" action="/classgroups/{{$classgroup->id}}/assign_task">
            @csrf
            <div class="form-group">
                <label for="classgroup">Class Group</label>
                <input type="text" class="form-control" name="classgroup" id="classgroup" placeholder="{{$classgroup->name}}" disabled>
            </div>
            <div class="form-group">
                <label for="task">Task</label>
                <select name="task" class="form-control" id="task">
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="task">Due Date: </label>
                <input type="date" id="due_date" name="due_date" value="{{$dates['min']}}" min="{{$dates['min']}}" max="{{$dates['max']}}">
            </div>
            <button type="submit" class="mt-4 btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
