@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Add New Class</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <form method="POST" action="/classgroups/store">
            @csrf
            <div class="form-group">
                <label for="name">Class Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Class Name">
            </div>
            <div class="form-group">
                <label for="year">Year Group</label>
                <input type="text" class="form-control" name="year" id="year" placeholder="Enter Year Group">
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
