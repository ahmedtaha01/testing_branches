<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    {{-- @if (auth()->user()->is_admin == true)
        <a href="{{ route('products.create') }}">create product</a>    
    @endif --}}

    <button id="deleteButton" style="display: none" onclick="deletePosts()">Delete</button>

    <div id="table_content_div">

    </div>
    {{-- <table class="table">
        <thead>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll" onclick="checkAll()">
                    </div>
                </td>
                <td>ID</td>
                <td>name</td>
                <td>description</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="boxes"
                            class='singleCheckBox' data="{{ $product->id }}" onclick="checkSingle(this)">
                        </div>
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                </tr>
                
            @empty
                <tr>
                    <td>
                        No data    
                    </td>
                </tr>    
            @endforelse
                
           
        </tbody>
    </table> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        // Get all checkboxes and the delete button
        function getData(){
            $.ajax({
                    // Our sample url to make request 
                    url:"{{ route('products.index') }}",

                    // Type of Request
                    type: "get",
                    dataType: "json",

                    // Function to call when to
                    // request is ok 
                    success: function (data) {
                        // let x = JSON.stringify(data);
                        $('#table_content_div').html(data.html);
                    },

                    // Error handling 
                    error: function (error) {
                        console.log(`Error ${error}`);
                    }
                });
        }
        $(window).on('load', function() {
            getData();
        });
        
            
            var deleteButton = document.getElementById('deleteButton');
            var num = 0;
            function checkSingle(ob){
                if(ob.checked){
                    num++;
                } else {
                    num--;
                }
                
                if(num > 0){
                    deleteButton.style.display = "block";
                } else {
                    deleteButton.style.display = "none";
                }
            }

            function checkAll(){
                var checkboxes = document.querySelectorAll("input[type=checkbox]");
                var allCheckBox = document.getElementById('checkAll')
                
                if(allCheckBox.checked){
                    num = checkboxes.length-1;
                    deleteButton.style.display = "block";
                    checkboxes.forEach(element => {
                        element.checked = true;
                    });
                } else {
                    num = 0;
                    deleteButton.style.display = "none";
                    checkboxes.forEach(element => {
                        element.checked = false;
                    });
                }
                
            }
            
            function deletePosts(){
                var arr = [];
                var ids = document.getElementsByName('boxes');
                // console.log(ids);
                for(var i = 0; i < ids.length ; i++) {
                    if(ids[i].checked == true) {
                        arr.push(ids[i].getAttribute('data'));
                    }
                }
                console.log(arr);
                $.ajax({
                    // Our sample url to make request 
                    url:"{{ route('products.destroyAll') }}",

                    // Type of Request
                    type: "delete",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'ids': arr,
                    },

                    // Function to call when to
                    // request is ok 
                    success: function (data) {
                        let x = JSON.stringify(data);
                        console.log(x);
                        getData();
                    },

                    // Error handling 
                    error: function (error) {
                        console.log(`Error ${error}`);
                    }
                });
            }

        
    </script>
</body>
</html>