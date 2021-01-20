<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $withdrawal->id }}</p>
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $withdrawal->member_id }}</p>
</div>

<!-- Withdrawal Date Field -->
<div class="form-group">
    {!! Form::label('withdrawal_date', 'Withdrawal Date:') !!}
    <p>{{ $withdrawal->withdrawal_date }}</p>
</div>

<!-- Reference Field -->
<div class="form-group">
    {!! Form::label('reference', 'Reference:') !!}
    <p>{{ $withdrawal->reference }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $withdrawal->amount }}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $withdrawal->transaction_id }}</p>
</div>

