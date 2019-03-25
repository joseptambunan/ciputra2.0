@if(isset($customer))
    {!! Form::model($customer,['method'=>'put','id'=>'frm']) !!}
@else
    {!! Form::open(['id'=>'frm']) !!}
@endif
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Detail</h4>
  </div>
  <div class="modal-body" id="modal{{$i}}">
  <form action="{{ url('/')}}/purchaserequest/edit_pr" method="post" name="form1" autocomplete="off">
    {!! csrf_field() !!}
    <input type="" name="id" value="{{$PRHeader->id}}" hidden>
    <input type="" name="department_id" value="{{$PRHeader->department_id}}" hidden>
    <div id="list_item" class="col-md-12">
      <div class="sub_list_item form-group col-md-12 panel panel-info">
        <div class="form-group panel-heading col-md-12"> Item {{ $i }}</div>
      <input type="" name="details_id[]" value="{{$value->id}}" hidden>

       <div class="form-group col-md-3">
            <label class="col-md-12" style="padding-left:0">Kategori</label>
            <select class="form-control col-md-12 parentcategory_data" name="parentcategory_name[]" id="sub_category_1 parentcategory_name" placeholder="Pilih Item" style="width: 100%" required>
              <option value="0">All Kategori</option>
              @foreach($parent_categories as $key => $v)
                <option value="{{ $v->id }}" {{ $value->item_project->item->item_category_id == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
              @endforeach
            </select>
        </div>

      <div class="form-group col-md-3">
              <label class="col-md-12" style="padding-left:0">Sub Kategori</label>
              <select class="form-control col-md-12 category_data" name="category_name[]" id="sk{{$i}} sub_category_1 category_name" placeholder="Pilih Item"  required>
                <option value="0">All Sub Kategori</option>
                 @foreach($categories as $key => $v)
                  <option value="{{ $v->id }}" {{ $value->item_project->item->sub_item_category_id == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-md-3">
              <label class="col-md-12" style="padding-left:0">Item</label>
              <select class="form-control col-md-12 item_data" name="item[]" id="it{{$i}} item_id_1 item_id" placeholder="Pilih Item"  required>
                <option value="0">All Item</option>
                 @foreach($item_result as $key => $v)
                  <option value="{{ $v['id'] }}" {{ $value->item_id == $v['id'] ? 'selected' : '' }}>{{ $v['name'] }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-md-2">
              <label class="col-md-12" style="padding-left:0">Brand</label>
                <select class="col-md-12 form-control brand_id" id="br{{$i}} brand_id" list="data_brand" name="brand[]" autocomplete="off" placeholder="Pilih Brand" required>
                  <option value="{{ $value->brand_id }}">{{ $value->brand->name }}</option>
                </select>
          </div>
          <div class="form-group col-md-2">
              <label class="col-md-12" style="padding-left:0">Qty</label>
             <input id="kuantitas1" name="kuantitas[]" type="number" value="{{$value->quantity}}" class="form-input col-md-12" placeholder="Input" min="1" required>
          </div>
          <div class="form-group col-md-2">
              <label class="col-md-12" style="padding-left:0">Satuan</label>
              <select id="si{{$i}} satuan_item1" name="satuan[]" class="form-input col-md-12 satuan_item" required>
              <option value="{{ $value->item_satuan_id }}">{{ $value->item_satuan->name }}</option>
              </select>
          </div>
           <div id="form_jumlah_komparasi_supplier" class="form-group col-md-12 ">
              <label class="col-md-12" style="padding-left:0">Jumlah Komparasi Supplier</label>
              <select id="" name="j_komparasi[]" class="form-input jumlah_komparasi{{$i}} col-md-12" onchange="banyak_komparasi({{$i}})" required>
                @for ($j = 1; $j < 4; $j++)
                  <option value="{{$j}}" {{$j == $value->recomended_supplier ? 'selected' : ''}}>{{$j}}</option>
                @endfor
              </select>
          </div>
          <div id="" class="col-md-4 form_komparasi_supplier_1_item{{$i}} form-group" hidden>
              <label class="col-md-12" style="padding-left:0">Komparasi Supplier 1</label>
              <select id="s1{{$i}} komparasi_supplier_1_" name="komparasi_supplier1[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,1,1)" required>
                <option selected disabled>Pilih Komparasi Supplier 1</option>
                 @foreach($rekanan_group as $key => $v )
                    <option value="{{ $v->id }}" {{ $v->id == $value->rec_1 ? 'selected' : ''}}>{{ $v->name}}</option>
                  @endforeach
              </select>
          </div>
           <div id="" class="col-md-4 form_komparasi_supplier_2_item{{$i}} form-group" hidden>
                <label class="col-md-12" style="padding-left:0">Komparasi Supplier 2</label>
                <select id="s2{{$i}} komparasi_supplier_2" name="komparasi_supplier2[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,2,1)">
                  <option selected disabled>Pilih Komparasi Supplier 2</option>
                    @foreach($rekanan_group as $key => $v )
                      <option value="{{ $v->id }}" {{ $v->id == $value->rec_2 ? 'selected' : ''}}>{{ $v->name}}</option>
                    @endforeach
                </select>
            </div>
            <div id="" class="col-md-4 form_komparasi_supplier_3_item{{$i}} form-group" hidden>
                <label class="col-md-12" style="padding-left:0">Komparasi Supplier 3</label>
                <select id="s3{{$i}} komparasi_supplier_3" name="komparasi_supplier3[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,3,1)" required>
                    <option selected disabled>Pilih Komparasi Supplier 3</option>
                    @foreach($rekanan_group as $key => $v )
                      <option value="{{ $v->id }}" {{ $v->id == $value->rec_3 ? 'selected' : ''}}>{{ $v->name}}</option>
                    @endforeach
              </select>
            </div>
            <div class="form-group col-md-12">
                <label class="col-md-12" style="padding-left:0">Kode Coa | Item Pekerjaan</label>
                <select id="ip{{$i}} data_itempekerjaan1" class="data_itempekerjaan form-input col-md-12" name="coa[]" placeholder="Pilih Item Pekerjaan" required>
                  @foreach($coa as $key => $v )
                      <option value="{{ $v->id }}" {{ $v->id == $value->itempekerjaan_id ? 'selected' : ''}}>{{ $v->name}}</option>
                  @endforeach
                </select>
            </div>
            <div id="form_deskripsi_umum" class="form-group col-md-12" style="margin-bottom:10px">
                <label class="col-md-12" style="padding-left:0">Deskripsi Item</label>
                <textarea id="deskripsi_item1" name="deskripsi_item[]" class="form-input col-md-12 item_desk" required>{{ $value->description }}</textarea>
            </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" value="Ubah" class="btn btn-primary pull-right">              
  </div>
  </form>
</div>
                                  
{!! Form::close() !!}