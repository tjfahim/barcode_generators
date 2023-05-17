

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barcode generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
<br>


                </div>
                <div class="pull-right mb-2">
                @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
                <form action="{{ route('barcode.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <a class="btn btn-success" style="margin-bottom: 20px;" href="">Generate Random Code:
</a>

<p><input name="barcode_number" type="text" value="{!! $number !!}"></p>

                    <div>

                        <div class="col-sm-6">


<hr>
<div>

{!!  DNS1D::getBarcodeHTML($number, 'C39',1,44); !!}

</div>

                        </div>
                    </div>
                   
                    </div>
                </div>
              
                <button type="submit" class="btn btn-primary ml-3">Submit</button>

            </div>
        </form>
                </div>
            </div>
        </div>
   
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Number</th>
                    <th>barcode</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($barcode as $crud)  
        <tr>  
            <td>{{$crud->id}}</td>  
            <td>{{$crud->barcode_number}}</td>  
            <td>
            <div class="mb-3"  >{!! DNS1D::getBarcodeSVG( $crud->barcode_number , 'C39',1,44) !!}</div>

        </td>  
<td >  

<form action="{{ route('barcode.destroy', $crud->id)}}" method="post">  
<a class="btn btn-primary" href="{{ route('barcode.download',$crud->id) }}">Download</a>

                  @csrf  
                  @method('DELETE')  
                  <button class="btn btn-danger" type="submit">Delete</button>  
                </form>  
                
</td>  
<td >  
</td>  
  
         </tr>  
@endforeach  
            </tbody>
        </table>
        {!! $barcode->links() !!}

    </div>
</body>
</html>