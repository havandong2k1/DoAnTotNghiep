@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ TÀI KHOẢN
    </div>

    <div class="table-responsive">
        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th style="width:150px;">Tên user</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Password</th>
              <th>Admin</th>
              <th>Staff</th>
              <th>Chức năng</th>
            </tr>
          </thead>
          <tbody>
            @foreach($admin as $key => $user)
              <tr class="user-item">
                <td>{{ $user->admin_name }}</td>
                <td>
                  {{ $user->admin_email }}
                  <input type="hidden" name="admin_id" value="{{ $user->admin_id }}">
                </td>
                <td>{{ $user->admin_phone }}</td>
                <td>{{ $user->admin_password }}</td>
                <td><input type="checkbox" value="admin" name="roles[]" {{ $user->hasRole('admin') ? 'checked' : '' }}></td>
                <td><input type="checkbox" value="staff" name="roles[]" {{ $user->hasRole('staff') ? 'checked' : '' }}></td>

                <td>
                  <button type="button" class="btn btn-sm btn-default btn__assign_role">Phân quyền</button>
                  <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{ URL::to('/delete-user/'.$user->admin_id) }}" class="btn btn-sm btn-danger">Xóa</a>
                </td> 
              </tr>
            @endforeach
          </tbody>
        </table>
   </div>

  </div>
</div>
@endsection
