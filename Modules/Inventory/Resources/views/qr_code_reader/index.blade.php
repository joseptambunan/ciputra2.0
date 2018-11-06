<!DOCTYPE html>
<html>
  <head>
    <title>Stock Opname</title>
     <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{ URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/instascan/instascan.min.js') }}"></script>
  </head>
  <body>

    <div class="">
      <div class ="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="container">
            <video id="preview"></video>
          </div>
          
        </div>
      </div>
      
    </div>


    <script type="text/javascript">
      $(document).ready(function(){
          $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        });
      });

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
  </body>
</html>