@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
@section('title', 'Supplier')
   
@section('content_header')
    <h1>Suppliers</h1>
@stop
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("suppliers.create") }}">
            Create New Supplier
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Supplier management data</h3>
    
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Role">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Supplier Name</th>
                  <th>Contact Person</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $role)
                <tr data-entry-id="{{ $role->id }}">
                  <td>{{ $role->id }}</td>
                  <td>{{ $role->supplier_name }}</td>
                  <td>{{ $role->kontaks }}</td>
                  <td>{{ $role->phone_number }}</td>
                  <td>{{ $role->email }}</td>
                  
                  <td>
                    

                    <a class="btn btn-xs btn-info" href="{{ route('suppliers.edit', $role->id) }}">
                        Edit
                    </a>

                    <form action="{{ route('suppliers.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan hapus?');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-xs btn-danger" value="Hapus">
                    </form>
                    <a class="btn btn-xs btn-{{ ($role->data_status==1?'primary':'danger') }}" href="{{ route('suppliers.show', $role->id) }}">
                        {{ ($role->data_status==1?'Active':'Not Active') }}
                    </a>
                </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Contact Person</th>
                    <th>Phone Number</th>
                    <th>Email</th>
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