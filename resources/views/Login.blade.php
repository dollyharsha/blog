<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 

<style>
    label{
        font-weight: 600;
    }
</style>

</head>
<body>
    <div class="d-flex justify-content-center p-2 m-2">
        <div class="card p-2 w-50">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h3>Login Page</h3>
                </div>
                <div class="">
                    <a href="{{url('admin')}}"><button class="btn btn-primary"><i class="fa fa-list"></i>Register</button></a>
                </div>
            </div>

       
            <div id="fordata"></div>
            <hr class="my-1">
            <form action="javascript:void(0)">
                @csrf
                <div class="row">
                    <div class="col">
                      <label for="">email</label>
                      <input type="text" name="email" id="email" class="form-control" required  placeholder="Enter email here..">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      <label for="">Password</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Enter password here..">
                    </div>
                </div>
          
          
                <div class="my-2">
                <button type="submit" class="btn btn-success w-100" onclick="getlogin()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

<script>
function getlogin()
{
   var email=$('#email').val();
   var password=$('#password').val();


   $.ajax({
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                url: "{{ route('Checklogin') }}",
                type: 'post',
                data: {
                    email:email,
                    password:password
                },
                success: function(response)
                {
                    console.log(response);
                    if(response.error)
                    {
                        $('#fordata').html("<div class='alert alert-warning alert-dismissible fade show'><strong>Warning!</strong>"+response.data+"</div>")    
                    }else if(response.statuscode==401)
                    {
                        $('#fordata').html("<div class='alert alert-warning alert-dismissible fade show'><strong>Warning!</strong>"+response.message+"</div>")  
                    }
                    else{
                        window.location = response.redirect_location;
                    }
                }
            });
}

</script>