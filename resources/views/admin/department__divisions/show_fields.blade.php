<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $departmentDivision->id }}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{{ $departmentDivision->department_id }}</p>
</div>

<!-- Division Id Field -->
<div class="form-group">
    {!! Form::label('division_id', 'Division Id:') !!}
    <p>{{ $departmentDivision->division_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $departmentDivision->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $departmentDivision->updated_at }}</p>
</div>

