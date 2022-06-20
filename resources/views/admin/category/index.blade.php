@extends('admin.main')
@section('content')
@include('admin.alert')
<div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th>Tên danh mục</th>
            <th colspan="2">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($category as $key => $value)
            <tr class="text-center">
              <td>{{ $value->name }}</td>
              <td class="text-center"><a class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(250, 244, 183))" href="{{ route('category.edit', $value->id) }}">Sửa</a></td>
              <td class="text-center">
                <form id="deleteForm" action="{{ route('category.destroy', $value->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(246, 198, 234))" value="Xóa">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <div class="pagination pagination-sm m-0 float-right">
        {{-- {{ $products->appends($_GET)->links() }} --}}
      </div>
    </div>
  </div>
@endsection