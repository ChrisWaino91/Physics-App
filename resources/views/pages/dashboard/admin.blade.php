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
                    <th>Classes</th>
                    <th>Tasks Set</th>
                    <th>Avg Grade</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dashboard['teachers'] as $teacher)
                    <tr>
                        <td class="text-center">{{ $teacher->id }}</td>
                        <td>{{ $teacher->forename . ' ' $teacher->surname }}</td>
                        <td>2</td>
                        <td>4</td>
                        <td>67%</td>
                        <td class="td-actions text-right">
                            <a href="/organisations/{{$teacher->id}}">
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
