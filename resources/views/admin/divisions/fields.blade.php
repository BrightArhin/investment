<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Unique Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unique_id', 'Unique Code:') !!}
    {!! Form::text('unique_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.divisions.index') }}" class="btn btn-secondary">Cancel</a>
</div>
