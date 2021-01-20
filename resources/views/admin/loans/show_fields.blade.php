<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $loan->id }}</p>
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $loan->member_id }}</p>
</div>

<!-- Loan Date Field -->
<div class="form-group">
    {!! Form::label('loan_date', 'Loan Date:') !!}
    <p>{{ $loan->loan_date }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $loan->amount }}</p>
</div>

<!-- Interest Rate Field -->
<div class="form-group">
    {!! Form::label('interest_rate', 'Interest Rate:') !!}
    <p>{{ $loan->interest_rate }}</p>
</div>

<!-- Interest Acc Date Field -->
<div class="form-group">
    {!! Form::label('interest_acc_date', 'Interest Acc Date:') !!}
    <p>{{ $loan->interest_acc_date }}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $loan->transaction_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $loan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $loan->updated_at }}</p>
</div>

