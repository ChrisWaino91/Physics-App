@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Tasks:</h4>
            </div>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Unit / Subunit</th>
                        <th>Num Of Questions</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($tasks as $task)
                        <tr>
                            <td></td>
                            <td>{{$task->name}}</td>
                            <td>{{$task->unit . " / " . $task->subUnit}}</td>
                            <td>{{$task->questions_count}}</td>
                            <td class="td-actions text-right">
                                <a href="/tasks/{{$task->id}}/complete_task">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon">
                                        <i class="tim-icons icon-single-02"></i>
                                    </button>
                                </a>
                                <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                    <i class="tim-icons icon-settings"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <a href="/tasks/create"><button type="submit" class="btn btn-primary">Create A New Task</button> </a>
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
