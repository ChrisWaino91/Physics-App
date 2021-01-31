@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Add New Student</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <form method="POST" action="/classgroups/{{$currentClass->id}}/store_student">
            @csrf
            @if ($teachers)
                <div class="form-group">
                        <label for="teacher">Teacher</label>
                        <select name="teacher" class="form-control" id="teacher">
                          @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->title . " " . $teacher->forename . " " . $teacher->surname}}</option>
                          @endforeach
                        </select>
                </div>
            @endif
            <div class="form-group">
                <label for="classgroup">Class Group</label>
                <select name="classgroup" class="form-control" id="classgroup">
                    <option value="{{ $currentClass->id }}">{{ $currentClass->name }}</option>
                    @if (!empty($classGroups))
                        @foreach ($classGroups as $singleClass)
                            <option value="{{ $singleClass->id }}">{{ $singleClass->name }}</option>
                        @endforeach
                    @endif
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
