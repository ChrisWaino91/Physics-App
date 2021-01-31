@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Active Organisations:</h4>
            </div>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Administrator</th>
                        <th>License Expiration</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($organisations as $organisation)
                        <tr>
                            <td class="text-center">{{ $organisation->id }}</td>
                            <td>{{ $organisation->name }}</td>
                            <td>{{ $organisation->user->forename . ' ' . $organisation->user->surname }}</td>
                            <td>{{ $organisation->expiry_date }}</td>
                            <td class="td-actions text-right">
                                <a href="/organisations/{{$organisation->id}}">
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
        <a href="/organisations/create"><button type="submit" class="btn btn-primary">Add A New Organisation</button> </a>
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
