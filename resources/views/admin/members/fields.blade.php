<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User :') !!}
{{--    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}--}}
    {!! Form::select('user_id', $users, '', ['class' => 'form-control', 'placeholder'=>'Please Select ...']) !!}

</div>


<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staff_id', 'Staff Id:') !!}
    {!! Form::number('staff_id', null, ['class' => 'form-control']) !!}
</div>



<!-- Department Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', 'Department :') !!}
    {!! Form::select('department_id', $departments, '', ['class' => 'form-control', 'placeholder'=>'Please Select ...']) !!}
</div>

<!-- Division Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('division_id', 'Division :') !!}
    {!! Form::select('division_id', $divisions, '', ['class' => 'form-control', 'placeholder'=>'Please Select ...']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Cancel</a>
</div>
