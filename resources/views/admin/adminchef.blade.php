<x-app-layout>

</x-app-layout>



<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.admincss')
  </head>
  <body>
   
  <div class="container-scroller">

            @include('admin.navbar')

            <form action="{{url('/uploadchef')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div>
                <label for="">Name</label>
                <input style="color:blue;" type="text" name="name" required placeholder="Enter Name">
            </div>


            
            <div>
                <label for="">Specialty</label>
                <input style="color:blue;" type="text" name="specialty" required placeholder="Enter Specialty">
            </div>


            <div>
                <input type="file" name="image" required>
            </div>


            <div>
                <input style="color:blue;" type="submit" value="Save">
            </div>


            </form>

            <table >


<tr>
    <th style="padding:30px;">Chef Name</th>
    <th style="padding:30px;">Specialty</th>
    <th style="padding:30px;">Image</th>
    <th style="padding:30px;">Update</th>
    <th style="padding:30px;">Delete</th>
</tr>



@foreach($data as $data)
<tr align="center">
    <td>{{$data->name}}</td>
    <td>{{$data->specialty}}</td>
    <td><img height="100px" width="100px" src="/chefimage/{{$data->image}}" alt=""></td>
    <td><a href="{{url('/updatechef',$data->id)}}" class="btn btn-primary">Update</a></td>
    <td><a href="{{url('/deletechef',$data->id)}}" class="btn btn-danger" onclick="return confirm('sure to delete?')">Delete</a></td>
</tr>

@endforeach

</table>






     



          






            </div>
      
   
   @include('admin.adminscript')
  </body>
</html>