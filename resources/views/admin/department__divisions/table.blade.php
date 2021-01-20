<div class="table-responsive-sm">
    <table class="table table-striped" id="departmentDivisions-table">
        <thead>
            <tr>
                <th>Department Id</th>
        <th>Division Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($departmentDivisions as $departmentDivision)
            <tr>
                <td>{{ $departmentDivision->department_id }}</td>
            <td>{{ $departmentDivision->division_id }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.departmentDivisions.destroy', $departmentDivision->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.departmentDivisions.show', [$departmentDivision->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.departmentDivisions.edit', [$departmentDivision->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>