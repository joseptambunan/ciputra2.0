
<:DOCTYPE html>
<html>
<head>
    <title>produk PDF </title>
    <link href=" {{ asset ('public bootstrap/css/
bootstrap.min.css') }} "rel="stylesheet">
<style>
    table, td, th {
        border: 1px solid black;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border-spacing:10px;
    }

    th {
        height: 50px;
    }
</style>
</head>
<body>
    <div class="panel panel - default">
        <div class="panel-heading">
            <h3 style="text-align: center;">{{$PRHeader->project->name}}</h3>
            <h3 style="text-align: center;">{{$PRHeader->project->address}}</h3>
            <h3 style="text-align: center;">PURCHASE REQUISTION BARANG (PR)</h3>
        </div>

        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">              
                <div class="col-md-6">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-5 col-xs-12">To</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <!-- <label class="col-md-12" style="padding-left:0">Rekanan</label> -->
                            : Purchasing Dept.
                        </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-5 col-xs-12" >From Division</label>
                          <div class="col-md-7">
                            : {{$PRHeader->project->name}}
                          </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-5 col-xs-12">Department </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <!-- <label class="col-md-12" style="padding-left:0">Rekanan</label> -->
                            : {{$PRHeader->department->name}}
                        </div>
                    </div>
                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-xs-12">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-5 col-xs-12">No </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <!-- <label class="col-md-12" style="padding-left:0">Rekanan</label> -->
                            : {{$PRHeader->no}}
                        </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-5 col-xs-12">Tanggal </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <!-- <label class="col-md-12" style="padding-left:0">Rekanan</label> -->
                            : {{$PRHeader->date}}
                        </div>
                    </div>
                  </div>

                </div>

                <div id="valueItem">
                  <div class="subValueItem col-md-12">
                    <table id="table_details" class="table table-bordered table-hover">
                        <thead class="col-md-12" style="background-color: gray;">
                            <tr>
                                <th >No </th>
                                <th >Item</th>
                                <th >Kode Item</th>
                                <th >Brand</th>
                                <th >Qty</th>
                                <th >Satuan</th>
                                <th >Deskripsi</th>
                                <th >SPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($PRDetail as $key => $value )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$value->item_project->item->name or 'Kosong'}}</td>
                                <td>{{$value->item_project->item->kode or 'Kosong'}}</td>
                                <td>{{$value->brand->name or 'Kosong'}}</td>
                                <td class="table-align-right">{{$value->quantity}}</td>
                                <td>{{$value->item_satuan->name or 'Kosong'}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->spk->name}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                  </div>
                </div>

                <br/>
                  <table width="100%" align="center" class="tgfooter" border="1pt">
                  <thead>
                    <tr>
                        <th>Requested By</th>
                        <th>Verified By</th>
                        <th>Approved By</th>
                      </tr>
                     <tr>
                      <th><h1>&nbsp;</h1></th>
                      <th><h1>&nbsp;</h1></th>
                      <th><h1>&nbsp;</h1></th>
                    </tr>
                  </thead>
                </table>
            <!-- <button id="btn-submit" type="submit" class="col-md-1 btn btn-primary" >Simpan</button> -->       
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
            </div>
            <!-- /.col -->
          </div>
        </div>
    </div>
</body>
</html>