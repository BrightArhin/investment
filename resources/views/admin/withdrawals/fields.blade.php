<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_id', 'Member :') !!}
    {!! Form::select('member_id', $members_array, '', ['class' => 'form-control', 'placeholder'=>'Please Select ...']) !!}
</div>

<!-- Withdrawal Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('withdrawal_date', 'Withdrawal Date:') !!}
    {!! Form::text('withdrawal_date', null, ['class' => 'form-control','id'=>'withdrawal_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#withdrawal_date').datetimepicker({
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

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {{ Form::hidden('transaction_type', 'withdrawal', array('id' => 'transaction_type')) }}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-secondary">Cancel</a>
</div>
