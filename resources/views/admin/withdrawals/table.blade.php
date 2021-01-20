@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

<div class="import-form">
    <form action="{{route('admin.import.withdrawal')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Import Excel File</label>
            <input type="file" name="excel_file" id="">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Import</button>

    </form>
</div>

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
