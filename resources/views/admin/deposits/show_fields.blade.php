<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $deposit->id }}</p>
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $deposit->member_id }}</p>
</div>

<!-- Deposit Date Field -->
<div class="form-group">
    {!! Form::label('deposit_date', 'Deposit Date:') !!}
    <p>{{ $deposit->deposit_date }}</p>
</div>

<!-- Reference Field -->
<div class="form-group">
    {!! Form::label('reference', 'Reference:') !!}
    <p>{{ $deposit->reference }}</p>
</div>

<!-- Narration Field -->
<div class="form-group">
    {!! Form::label('narration', 'Narration:') !!}
    <p>{{ $deposit->narration }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $deposit->amount }}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $deposit->transaction_id }}</p>
</div>

