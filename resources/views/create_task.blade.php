@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Create New Task</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <form method="POST" action="/tasks/store">
            @csrf
            <div class="form-group">
                <label for="topic">Related Topic:</label>
                    <select name="topic" class="form-control" id="topic">
                        @foreach ($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic->name}}</option>
                        @endforeach
                    </select>
                </option>
            </div>
            <div class="form-group">
                <label id="name" for="name">Task Name:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Functional {{$placeholder->name}}">
            </div>
            <hr/>
            <div id="wrapper">
                <div id="duplicate">
                    <div class="form-group" id="question">
                        <label id="question_label" for="question">Question</label>
                        <input type="text" class="form-control" name="questions[]" id="question_input" placeholder="Question 1">
                    </div>
                    <div class="form-group" id="answer">
                        <div class="row">
                            <div class="col">
                                <label id="answers_label" for="answer1">Answer</label>
                                <input type="text" class="form-control" name="answers[]" id="answers" placeholder="Correct Answer">
                            </div>
                            <div class="col">
                                <label id="options_label" for="options">Options</label>
                                <input type="text" class="form-control" name="options[]" id="options" placeholder="Possible Options - 1">
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
            <div><button type="button" class="btn btn-info btn-sm" id="additional">Add Additional Question</button></div>
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


        i = 2;
        $("#additional").unbind("click").click(function() {

            $("#delete").remove();

            $("#wrapper").append('<span id="delete">x</span><div id="duplicate'+i+'""><div class="form-group" id="question'+i+'_div"><label id="question'+i+'_label" for="question'+i+'">Question '+i+'</label><input type="text" class="form-control" name="questions[]" id="question'+i+'_input" placeholder="Question '+i+'"></div> <div class="form-group" id="answer'+i+'_div"><div class="row"><div class="col"><label id="answer'+i+'_label" for="answer'+i+'">Answer '+i+'</label> <input type="text" class="form-control" name="answers[]" id="answer'+i+'" placeholder="Correct Answer"> </div><div class="col"><label id="options'+i+'_label" for="options'+i+'">Answer '+i+'</label><input type="text" class="form-control" name="options[]" id="options'+i+'" placeholder="Possible Options '+i+'"></div> </div><hr/></div></div>');

            i++;
        });

        $(document).unbind("mouseup").on('mouseup', '#delete', function() {
            x = i-1;
            y = x-1;
            $("#duplicate"+x).remove();
            $("#delete").remove();

            $("#duplicate"+y).prepend('<span id="delete">x</span>');
            i--;
        });

    </script>
@endpush
