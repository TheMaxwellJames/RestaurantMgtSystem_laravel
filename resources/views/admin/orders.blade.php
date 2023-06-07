<x-app-layout>

</x-app-layout>



<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  @include('admin.admincss')
  </head>
  <body>
   
  <div class="container-scroller">

            @include('admin.navbar')


            <div class="container">


            <form action="{{ url('/search') }}" method="GET">
  @csrf

  <h2>Customers Order</h2>

  <input type="text" name="search" id="search" style="color: blue;">
  <div id="search-results"></div> <!-- Container for displaying the search results -->

  <input type="submit" value="Search" class="btn btn-success">
</form>







            <table>

            <tr align="center">
                <th style="padding:30px;">Name</th>
                <th style="padding:30px;">Phone</th>
                <th style="padding:30px;">Address</th>
                <th style="padding:30px;">Foodname</th>
                <th style="padding:30px;">Price</th>
                <th style="padding:30px;">Quantity</th>
                <th style="padding:30px;">Total Price</th>
             
            </tr>




        @foreach($data as $data)    
            <tr align="center" style="background-color: black;">
                <td>{{$data->name}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->address}}</td>
                <td>{{$data->foodname}}</td>
                <td>{{$data->price}}$</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->price * $data->quantity}}$</td>
            </tr>

            @endforeach






            </table>



            </div>















            </div>
      
   
   @include('admin.adminscript')
  </body>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#search').on('input', function() {
      var searchText = $(this).val();
      if (searchText.length > 0) {
        $.ajax({
          url: '/search',
          type: 'GET',
          data: { search: searchText },
          success: function(response) {
            var resultsContainer = $('#search-results');
            resultsContainer.empty(); // Clear previous results

            // Display the retrieved names as clickable suggestions
            response.data.forEach(function(order) {
              var name = order.name;
              var suggestion = $('<div class="search-suggestion">' + name + '</div>');

              // Handle click event on the suggestion
              suggestion.click(function() {
                $('#search').val(name); // Populate the search input field
                resultsContainer.empty(); // Clear suggestions
              });

              resultsContainer.append(suggestion);
            });
          }
        });
      } else {
        // Clear suggestions if the search input is empty
        $('#search-results').empty();
      }
    });
  });
</script>


 
 







</html>