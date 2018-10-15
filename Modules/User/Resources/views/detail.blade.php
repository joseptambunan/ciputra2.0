<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data User <strong>{{ $users->user_name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-12"><h3 class="box-title">Edit Data Username</h3></div>
            <div class="col-md-6">              
              <form action="{{ url('/')}}/user/update-user" method="post" name="form1">
                  {{ csrf_field() }}                  
                  <input type="hidden" name="userid" id="userid" value="{{ $users->id }}">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" name="username" value="{{ $users->user_name }}" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Userlogin</label>
                      <input type="text" class="form-control" name="userlogin" value="{{ $users->user_login }}" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Rekanan</label>
                      <select class="form-control" name="isrekanan">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" value="{{ $users->email }}" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" class="form-control" name="phone" value="{{ $users->phone }}" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" name="password" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="description" rows="3" class="form-control">{{ $users->description}}</textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/')}}/user/master" class="btn btn-warning">Kembali</a>
                  </div>
                </form>
            </div> 
         
          <!-- /.col -->
          <div class="col-md-12">
            <hr style="border-color: red;">
            <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs">                
                <li class="active"><a href="#tab_3" data-toggle="tab">Project</a></li>
                <li><a href="#tab_1" data-toggle="tab">Approval Document</a></li>
                <li><a href="#tab_2" data-toggle="tab">Jabatan</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane " id="tab_1">
                 <!--  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                   Set Approval
                  </button><br><br> -->
                  <div class="nav-tabs-custom">
              
                    <ul class="nav nav-tabs">        
                      @foreach ( $project_pt_user as $key6 => $value6 )   
                      @if ( $key6 == 0 )     
                      <li  class="active"><a href="#tab_{{ $key6 + 5 }}" data-toggle="tab">{{ $value6->project->name }}</a></li>
                      @else
                      <li><a href="#tab_{{ $key6 + 5 }}" data-toggle="tab">{{ $value6->project->name }}</a></li>
                      @endif
                      @endforeach
                    </ul>

                    <div class="tab-content">
                      @php $active = ""; @endphp
                      @foreach ( $project_pt_user as $key6 => $value6 )  
                        @if ( $key6 == 0 ) 
                          @php $active = "active"; @endphp
                        @endif
                        <div class="tab-pane {{ $active }}" id="tab_{{ $key6 + 5 }}">

                        @php $nilai = 0; @endphp
                        @foreach ( $value6->user->details as $key7 => $value7 )                    
                          @if ( $value6->pt_id == $value7->mappingperusahaan->pt->id )
                            @if ( $value7->can_approve == "1")
                            @php $nilai = $nilai + 1; @endphp
                            @endif
                          @endif
                        @endforeach

                        @if ( $nilai > 0 )
                        <a class="btn btn-info" href="{{ url('/')}}/user/approval/user_detail?id={{ $value6->id}}">
                            Set Approval
                        </a>
                        @endif
                        <table class="table-bordered table">
                          <thead class="head_table">
                            <tr>
                              <td>Document</td>
                              <td>Nilai Document</td>
                              <td>Nomor Urut</td>
                              <td>Perubahan Data</td>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ( $users->approval_reference as $key7 => $value7 )
                            @if ( $value7->pt_id == $value6->pt->id && $value7->project_id == $value6->project_id )
                              <tr>
                                  <td>{{ $value7->document_type }}</td>
                                  <td>{{ number_format($value7->min_value )}}</td>
                                  <td>{{ number_format($value7->no_urut )}}</td>
                                  <td><button class="btn btn-danger" onclick="deleteApproval('{{ $value7->id }}')">Delete</a></td>
                              </tr>
                            @endif
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                      @endforeach                     
                     
                    </div>
                  </div>
                  
                  
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <h3>Isi Jabatan Proyek</h3>
                  <form action="{{ url('/')}}/user/save-detail" method="post">
                    <input type="hidden" class="form-control" name="user_id" value="{{ $users->id }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Jabatan</label>
                      <select class="form-control" id="jabatan" name="jabatan">
                       @foreach ( $jabatan as $key => $value )
                       <option value="{{ $value->id }}">{{ $value->name }}</option>
                       @endforeach
                      </select>
                    </div>

                    <div class="form-group project">
                      <label>Project - PT</label>
                      <select class="form-control" name="project_pt" id="project_pt">
                       @foreach ( $project_pt_user as $key => $value )
                       <option value="{{ $value->id }}">{{ $value->project->name }} - {{ $value->pt->name }}</option>
                       @endforeach
                      </select>
                    </div>


                    <div class="form-group dept" id="input_dept" style="display: none;">
                      <label>Department / Divisi</label><br>
                      @foreach ( $project_pt_user as $key => $value )
                        @foreach ( $value->pt->mapping as $key2 => $value2 )
                          <input type="checkbox" name="dept[{{ $value2->id}}]" class="pt pt_{{ $value->id}}" style="display: none;" value="{{ $value2->id }}"> {{ $value2->department->name }} {{ $value2->division->name }}
                        @endforeach
                      @endforeach
                    </div>

                    <div class="form-group">
                      <label>Can Approve</label>
                      <input type="checkbox" name="is_approve">
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Simpan</button>

                    </div>

                  </form>
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>PT</td>
                        <td>Department</td>
                        <td>Divisi</td>
                        <td>Jabatan</td>
                        <td>Delete</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $users->jabatan as $key => $value )
                      <tr>
                        <td>{{ $value['pt'] }}</td>
                        <td>{{ $value['department'] }}</td>
                        <td>{{ $value['division'] }}</td>
                        <td>{{ $value['jabatan'] }}</td>
                        <td><button class="btn btn-danger" onclick="removeuser('{{ $value['pt_id']}}','{{ $users->id}}','{{ $value['jabatan_id']}}')">Delete</button></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_3">
                    <h3>Tambah Akses</h3>
                    <div class="col-md-6">              
                    <form action="{{ url('/')}}/user/save-project_pt" method="post" name="form1">
                        {{ csrf_field() }}                  
                        <input type="hidden" name="userid" id="userid" value="{{ $users->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project</label>
                            <select class="form-control" required name="project_s">
                              @foreach( $project as $key7 => $value7 )
                              <option value="{{ $value7->id }}">{{ $value7->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">PT</label>
                            <select class="form-control" required name="pt_s">
                              @foreach( $pt as $key8 => $value8 )
                              <option value="{{ $value8->id }}">{{ $value8->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                  </div> 
                    <table class="table table-bordered">
                      <thead style="background-color: greenyellow;">
                        <tr>
                          <td>Project</td>
                          <td>PT</td>
                          <td>Perubahan Data</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $project_pt_user as $key => $value )
                        <tr>
                          <td>
                            <input type="hidden" name="user_project_pt" id="user_project_pt_{{ $value->id }}" value="{{ $value->id }}">
                            <span id="label_project_{{ $value->id }}">{{ $value->project->name }}</span>
                            <select class="form-control project" name="project_name" id="project_name_{{ $value->id }}" style="display: none;">
                              @foreach ( $project as $key2 => $value2)
                              @if ( $value2->id == $value->project->id )
                              <option value="{{ $value2->id}}" selected>{{ $value2->name }}</option>
                              @else
                              <option value="{{ $value2->id}}">{{ $value2->name }}</option>
                              @endif
                              @endforeach
                            </select>
                          </td>
                          <td>
                            <span id="label_pt_{{ $value->id }}">{{ $value->pt->name }}</span>
                            <select class="form-control pt" name="pt_name" id="pt_name{{ $value->id }}" style="display: none;">
                              @foreach ( $pt as $key3 => $value3)
                              @if ( $value3->id == $value->pt->id )
                              <option value="{{ $value3->id}}" selected>{{ $value3->name }}</option>
                              @else
                              <option value="{{ $value3->id}}">{{ $value3->name }}</option>
                              @endif
                              @endforeach
                            </select>
                          </td>
                          <td>
                            <button class="btn btn-warning" id="btn_edit_{{ $value->id }}" onclick="editpt('{{ $value->id }}')">Edit</button>
                            <button class="btn btn-success" id="btn_save_{{ $value->id }}" onclick="savept('{{ $value->id }}')" style="display: none;">Edit</button>
                            <button class="btn btn-danger" onclick="deletept('{{ $value->id }}')">Delete</button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
          </div>
          <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  <div class="modal fade" id="modal-info">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Primary Modal</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/user/save-approval" method="post" name="form1">
              <input type="hidden" name="userid" id="userid" value="{{ $users->id }}">
              <div class="form-group">
                <div class="col-md-3">
                  <select class="form-control project" name="project_name" id="project_name">
                    @foreach ( $project_pt_user as $key4 => $value4 )                     
                    <option value="{{ $value4->project->id}}">{{ $value4->project->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-3">
                  <select class="form-control project" name="pt_name" id="pt_name">
                    @foreach ( $project_pt_user as $key4 => $value4 )                     
                    <option value="{{ $value4->pt->id}}">{{ $value4->pt->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div><br><br>
              {{ csrf_field() }}
              <table class="table table-bordered">
                <thead style="background-color: greenyellow;">
                  <tr>
                    <td>Approve</td>
                    <td>Document</td>
                    <td>Nilai Document</td>
                    <td>Nomor Urut</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="3"><input type="checkbox" name="check_all" id="check_all"></td>
                  </tr>
                  @if ( count($project_pt_user) > 0 )
                  @foreach ( $document as $key3 => $value3 )
                  <tr>
                    <td><input type="hidden" name="document_[{{ $key3}} ]" value="{{ $value3->head_type }}">
                      <input type="checkbox" name="check_[{{ $key3}}]"> Approve</td>
                    <td>{{ $value3->head_type }}</td>
                    <td><input type="text" name="min_value_[{{ $key3}}]" value="" class="form-control"></td>
                    <td>
                      <select class="form-control project" name="urut[{{ $key3 }}]" id="urut[{{ $key3 }}]">
                        @for ( $i=1; $i < 8; $i++ )                     
                        <option value="{{ $i}}">Level {{ $i}}</option>
                        @endfor
                      </select>
                    </td>
                  </tr>
                  @endforeach
                  @endif
              </tbody>
              </table>
              <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal  fade" id="modal-primary">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Progress</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>

@include("user::app")
<script type="text/javascript">
  function removeuser(pt_id,user_id,jabatan_id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
      var request = $.ajax({
        url : "{{ url('/')}}/user/delete-detail",
        dataType : "json",
        data : {
          pt : pt_id,
          user_id : user_id,
          jabatan_id : jabatan_id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }
</script>
</body>
</html>
