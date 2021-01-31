@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Add New Organisation</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <form method="POST" action="/organisations/store">
            @csrf
            <div class="form-group">
                <label for="organisation">Organisation Name</label>
                <input type="text" class="form-control" name="organisation" id="organisation" placeholder="Organisation Name">
            </div>
            <small id="administrator_help" class="mb-2 form-text text-muted">Enter the details of the lead administrator below.</small>
            <div class="form-group">
                <label for="title">Title</label>
                <select name="title" class="form-control" id="title">
                  <option value="Mr">Mr</option>
                  <option value="Mrs">Mrs</option>
                  <option value="Ms">Ms</option>
                  <option value="Miss">Miss</option>
                  <option value="Dr">Dr</option>
                  <option value="Prof">Prof</option>
                </select>
            </div>
            <div class="form-group">
                <label for="forename">Forename</label>
                <input type="text" class="form-control" name="forename" id="forename" placeholder="Enter Forename">
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="Enter Surname">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" name="demo" type="checkbox" value="demo">
                    <span class="form-check-sign">
                        <span class="check">Demo?</span>
                    </span>
                </label>
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
