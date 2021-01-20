<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_id', 'Member Id:') !!}
    {!! Form::number('member_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Loan Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loan_date', 'Loan Date:') !!}
    {!! Form::text('loan_date', null, ['class' => 'form-control','id'=>'loan_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#loan_date').datetimepicker({
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


<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control','id'=>'amount']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#amount').datetimepicker({
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


<!-- Interest Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('interest_rate', 'Interest Rate:') !!}
    {!! Form::number('interest_rate', null, ['class' => 'form-control']) !!}
</div>

<!-- Interest Acc Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('interest_acc_date', 'Interest Acc Date:') !!}
    {!! Form::text('interest_acc_date', null, ['class' => 'form-control','id'=>'interest_acc_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#interest_acc_date').datetimepicker({
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




<div class="form-group col-sm-6">
    {{ Form::hidden('transaction_type', 'loan', array('id' => 'transaction_type')) }}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary">Cancel</a>
</div>
