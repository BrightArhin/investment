<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_id', 'Member :') !!}
{{--    {!! Form::number('member_id', null, ['class' => 'form-control']) !!}--}}
    {!! Form::select('member_id', $members_array, '', ['class' => 'form-control', 'placeholder'=>'Please Select ...']) !!}

</div>

<!-- Deposit Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposit_date', 'Deposit Date:') !!}
    {!! Form::text('deposit_date', null, ['class' => 'form-control','id'=>'deposit_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#deposit_date').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Reference Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference', 'Reference:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control']) !!}
</div>

<!-- Narration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('narration', 'Narration:') !!}
    {!! Form::text('narration', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {{ Form::hidden('transaction_type', 'deposit', array('id' => 'transaction_type')) }}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.deposits.index') }}" class="btn btn-secondary">Cancel</a>
</div>
