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
      <h1>Data Item Pekerjaan <strong>{{ $itempekerjaan->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-12"><h3 class="box-title">Edit Data Pekerjaan</h3></div>
            <div class="col-md-6">              
              <form action="{{ url('/')}}/pekerjaan/update-pekerjaan" method="post" name="form1">
              <input type="hidden" name="id" id="id" value="{{ $itempekerjaan->id }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Sub Holding</label>
                <select class="form-control" name="subholding">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div class="form-group">
                <label>Code Pekerjaan</label>
                <input type="text" class="form-control" name="code" value="{{ $itempekerjaan->code }}">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $itempekerjaan->name }}">
              </div>
              <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department">
                  @foreach ( $department as $key => $value)
                  @if ( $value->id == $itempekerjaan->department_id )
                  <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                  @else                  
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
          </div>    
          <div class="col-md-6">   
              <div class="form-group">
                <label>Ppn</label>
                <input type="text" class="form-control" name="ppn" value="10" id="ppn" value="{{ $itempekerjaan->ppn }}">
              </div>
              <div class="form-group">
                <label>Tag</label>
                <select class='form-control' name='tag' id="tag">
                  <option value='0'>Item Pekerjaan Unit</option>
                  <option value='1'>Item Pekerjaan Non Unit</option>
                  <option value='2'>Others</option>
                </select>
              </div>
              <div class="form-group">
                <label>Group Cost</label>
                <select class='form-control' name='group_cost' id="group_cost">
                  @foreach ( $budgetgroup as $key2 => $value2 )
                  @if ( $value2->id == $itempekerjaan->group_cost )
                  <option value="{{ $value2->id }}" selected>{{ $value2->name }}</option>
                  @else
                  <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>  
   
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="description" rows="3">{{ $itempekerjaan->description }}</textarea>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-danger" onclick="deleteCoa('{{ $itempekerjaan->id }}')">Hapus Pekerjaan</button>
                <a class="btn btn-warning" href="{{ url('/')}}/pekerjaan">Kembali</a>
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <hr style="border-color: red;">
              <div class="nav-tabs-custom">
                
                <ul class="nav nav-tabs">
                  <li ><a href="#tab_1" data-toggle="tab">COA Department</a></li>
                  <li class="active"><a href="#tab_2" data-toggle="tab">Sub Item Pekerjaan</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane " id="tab_1">
                    <h2>COA : <strong>{{ $itempekerjaan->coas->first()->code or '' }}</strong></h2>
                    <form action="{{ url('/')}}/pekerjaan/add-coas" method="post" name="form1">
                      {{ csrf_field() }}
                      <input type="hidden" name="coas_itempekerjaan" id="coas_itempekerjaan" value="{{ $itempekerjaan->id }}">
                      <div class="form-group">
                        <label>Item COA</label>
                        <select class="form-control select2" name="coa">
                          @foreach( $coa as $key => $value)
                          <option value="{{ $value->id }}">{{ $value->code }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>  
                    <br><br>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="tab_2">
                      <!-- /.form-group -->
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                        Launch Info Modal
                      </button>
                      <table id="example3" class="table table-bordered table-responsive">
                        <thead style="background-color: greenyellow;">
                          <tr>
                            <td>Item Pekerjaan</td>
                            <td>Bobot</td>
                            <td>Termin 1</td>
                            <td>Termin 2</td>
                            <td>Termin 3</td>
                            <td>Termin 4</td>
                            <td>Termin 5</td>
                            <td>Termin 6</td>
                            <td>Termin 7</td>
                            <td>Termin 8</td>
                            <td>Termin 9</td>
                            <td>Termin 10</td>
                          </tr>
                        </thead>
                        <tbody>                          
                          <tr>
                            <td><strong>{{ $itempekerjaan->name }}</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          @foreach ( $itempekerjaan->child_item as $key3 => $value3 )
                          <tr>
                            <td style="background-color: grey;color:white;font-weight: bolder;" onclick="showhide('{{ $value3->id }}')" data-attribute='1' id='btn_{{ $value3->id }}'>&nbsp;&nbsp;{{ $value3->name }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          @if ( count($value3->child_item) > 0 )
                            @foreach ( $value3->child_item as $key4 => $value4 )
                            <tr class="class_{{ $value3->id}}">
                              <td style="background-color: blue;color:white;font-weight: bolder;" >
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value4->name }}
                                <button type="button" onclick="setItem('{{ $value4->id}}','{{ $value4->name }}','{{ $itempekerjaan->id }}')" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-primary">
                                      Bobot
                                    </button>
                              </td>
                              <td>{{ $value4->item_progress->sum('percentage') }}</td>
                              <td>{{ $value4->item_progress[0]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[1]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[2]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[3]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[4]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[5]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[6]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[7]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[8]->percentage or '0.00' }}</td>
                              <td>{{ $value4->item_progress[9]->percentage or '0.00' }}</td>
                            </tr>
                              @if ( count($value4->child_item) > 0 )
                                @foreach ( $value4->child_item as $key5 => $value5 )
                                <tr class="class_{{ $value3->id}}">
                                  <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value5->name }}
                                    <button type="button" onclick="setItem('{{ $value5->id}}','{{ $value5->name }}','{{ $itempekerjaan->id }}')" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-primary">
                                      Bobot
                                    </button>
                                  </td>
                                  <td>{{ $value5->item_progress->sum('percentage') }}</td>
                                  <td>{{ $value5->item_progress[0]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[1]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[2]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[3]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[4]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[5]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[6]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[7]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[8]->percentage or '0.00' }}</td>
                                  <td>{{ $value5->item_progress[9]->percentage or '0.00' }}</td>
                                </tr>
                                @endforeach
                              @endif
                            @endforeach
                          @endif
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
          <form action="{{ url('/')}}/pekerjaan/add-progress" method="post" name="form1">
              <input type="hidden" name="item_id" id="item_id">
              <input type="hidden" name="coa_id" id="coa_id" value="{{ $itempekerjaan->id }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Item Pekerjaan</label>
                <input type="text" class="form-control" name="item_name" id="item_name" value="" readonly>
              </div>
              <table class="table table-bordered">
                <tr>                  
                  <td>Termin 1</td>
                  <td><input type="text" name="item[0]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 2</td>
                  <td><input type="text" name="item[1]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 3</td>
                  <td><input type="text" name="item[2]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 4</td>
                  <td><input type="text" name="item[3]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 5</td>
                  <td><input type="text" name="item[4]"></td>                 
                </tr><tr>                  
                  <td>Termin 6</td>
                  <td><input type="text" name="item[5]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 7</td>
                  <td><input type="text" name="item[6]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 8</td>
                  <td><input type="text" name="item[7]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 9</td>
                  <td><input type="text" name="item[8]"></td>                 
                </tr>
                <tr>                  
                  <td>Termin 10</td>
                  <td><input type="text" name="item[9]"></td>                 
                </tr>
              </table>              
              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
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
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">

</script>
@include("pekerjaan::app")
</body>
</html>
