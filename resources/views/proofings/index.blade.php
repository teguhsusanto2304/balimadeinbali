@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
@section('title', 'Supplier')
   
@section('content_header')
    <h1>Proofing</h1>
@stop
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("proofings.create") }}">
            Create New Proofing
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Proofing management data</h3>
    
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Role">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Time</th>
                  <th>Supplier Name</th>
                  <th>Purchasing Order</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $data)
                <tr data-entry-id="{{ $data->id }}">
                  <td><img src="{{ $data->path_image }}" width="100" height="100"></td>
                  <td>{{ $data->proofing_at }}</td>
                  <td>{{ $data->supplier[0]->supplier_name }}</td>
                  <td>
                    @switch($data->data_status)
                    @case(2)
                      <a class="btn btn-xs btn-info" href="{{ route('proofings.edit', $data->id) }}">
                        Create Purchasing Order
                      </a>
                      @break
                      @default
                      {{ $data->purchasing_order_id }}
                    @endswitch  
                    </td>
                  <td>
                    @switch($data->data_status)
                    @case(0)
                    <span class="badge badge-danger">Rejected</span>
                    @break
                    @case(1)
                        <a href="" class="btn btn-xs btn-warning">On Progress</a>
                        @break                
                    @case(2)
                    <span class="badge badge-primary">Complete</span>
                        @break                
                    @default
                        <span>Something went wrong, please try again</span>
                    @endswitch  
                  </td>                  
                  <td>
                    @switch($data->data_status)
                    @case(0)
                    @break
                    @case(1)
                      <a class="btn btn-xs btn-info" href="{{ route('proofings.edit', $data->id) }}">
                          Edit
                      </a>

                      <form action="{{ route('suppliers.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan hapus?');" style="display: inline-block;">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="submit" class="btn btn-xs btn-danger" value="Hapus">
                      </form>
                        @break                
                    @case(2)
                        @break                
                    @default
                        <span>Something went wrong, please try again</span>
                    @endswitch  

                    
                </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Image</th>
                  <th>Time</th>
                  <th>Supplier Name</th>
                  <th>Purchasing Order</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
        </div>
    </div>

  
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css') }} ">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'Hapus'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "suppliers.create",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('Apakah anda akan hapus')

        return
      }

      if (confirm('Apakah anda akan hapus')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@stop