@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')

<div class="row">
    @foreach ($outstandingTasks as $task)
        <div class="col-lg-4">
            <div style="min-height:210px;" class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Outstanding Task:</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-info mr-2"></i>{{$task->name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        use this to create charts of completion and due date countdown -https://dribbble.com/shots/8760118-Security-Data-Manager-App
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Total Shipments</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartLinePurple"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Daily Sales</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="CountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Completed Tasks</h5>
                <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartLineGreen"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Students:</h4>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Avg Grade</th>
                        <th>Missed Tasks</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($students as $student)
                        <tr>
                            <td class="text-center">{{ $student->id }}</td>
                            <td>{{ $student->forename . ' ' . $student->surname }}</td>
                            <td>73%</td>
                            <td>3</td>
                            <td class="td-actions text-right">
                                <a href="/students/{{$student->user_id}}">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon">
                                        <i class="tim-icons icon-single-02"></i>
                                    </button>

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
        <a href="/classgroups/{{$classgroup->id}}/create_student"><button type="submit" class="btn btn-primary">Add A Student</button> </a>
        <a href="/classgroups/{{$classgroup->id}}/set_task"><button type="submit" class="btn btn-primary">Set A Task</button> </a>
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
