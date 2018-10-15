<form action="{{ url('/')}}/tenderpurchaserequest/add-test2" method="post" enctype="multipart/form-data" name="form1">
    {{ csrf_field() }}
    <input type="file" name="testfile">
    <input type="submit">
</form>
