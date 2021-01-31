@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> {{$task->name}} </h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <form method="POST" action="/tasks/{{$task->id}}/submit_task">
            @csrf
                @foreach ($questions as $question_key => $question)
                    <div class="form-group mt-2">
                    <label for="question"><h4>{{$question->question}}</h4></label>
                        @foreach ($question->options as $option_key => $option)
                            <div class="form-group ml-2">
                                <input class="mr-2" type="radio" value="{{$option_key}}" name="question{{$question_key}}">
                                <label>{{$option}}</label>
                            </div>
                        @endforeach
                        <hr/>
                @endforeach
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
