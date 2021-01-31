<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Active Organisations:</h4>
        </div>
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

                @foreach ($dashboard['organisations'] as $organisation)
                    <tr>
                        <td class="text-center">{{ $organisation->id }}</td>
                        <td>{{ $organisation->name }}</td>
                        <td>{{ $organisation->user->forename . " " . $organisation->user->surname }}</td>
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
</div>
