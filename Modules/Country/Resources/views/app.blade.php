<script type="text/javascript">
  $( document ).ready(function() {
     $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
  });

  function showhide(id){
    alert($("btn_" + id).attr("data-status"));
    if ( $("btn_" + id).attr("data-attribute") == "1"){
      $(".provinces").hide();
      $(".provinces_" +id).show(1000);
      $("#icon_minus_" + id).show();
      $("#icon_plus_" + id).hide();      
      $("btn_" + id).attr("data-attribute","0");
    }else{
      $(".provinces").hide();
      $("#icon_minus_" + id).hide();
      $("#icon_plus_" + id).show();      
      $("btn_" + id).attr("data-attribute","1");
    }
  }

  function deleteCity(id,cityname){
    if ( confirm("Apakah anda yakin ingin menghapus kota " + cityname )){
      var request = $.ajax({
        url : "/country/deletecity/",
        data: {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Kota " + cityname + " telah dihapus ");
          window.location.reload();
        }else{
          alert("Terjadi Kesalahan Data");
          window.location.reload();
        }
      });
    }else{
      return false;
    }
  }

  function deleteProvince(province,province_name){
    if ( confirm("Apakah anda yakin ingin menghapus provinsi " + province_name )){
      var request = $.ajax({
        url : "/country/deleteProvince/",
        data: {
          id : province
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Provinsi " + province_name + " telah dihapus ");
          window.location.reload();
        }else{
          alert("Terjadi Kesalahan Data");
          window.location.reload();
        }
      });
    }else{
      return false;
    }
  }

  function updateCity(id){   

    $(".labels").show();
    $("#label_"+ id).hide();

    $(".btn-warning").show();
    $(".btn-success").hide();      
    $("#btn_ubah_" + id).hide();  
    $("#btn_edit_" + id).show();

    $(".col-xs-4").hide();
    $("#city_" + id).show();

  }

  function updateProvince(id){   

    $(".labels").show();
    $("#label_prov_"+ id).hide();

    $(".btn-warning").show();
    $(".btn-success").hide();      
    $("#btn_provubah_" + id).hide();  
    $("#btn_provedit_" + id).show();

    $(".col-xs-4").hide();
    $("#province_" + id).show();

  }

  function updCitie(id,cityname){
    var request = $.ajax({
      url : "/country/updatecity/",
      data : {
        id : id,
        city : $("#city_" +id).val()
      },
      dataType : "json",
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert( "Kota " + cityname + " telah diganti dengan " + $("#city_" +id).val());
        window.location.reload();
      }
    })
  }

  function updProvince(id,province){
    var request = $.ajax({
      url : "/country/updateprov/",
      data : {
        id : id,
        province : $("#province_" +id).val()
      },
      dataType : "json",
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert( "Provinsi " + province + " telah diganti dengan " + $("#province_" +id).val());
        window.location.reload();
      }
    })
  }
</script>