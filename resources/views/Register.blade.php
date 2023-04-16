<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLOG</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
                    <h3>Register YourSelf</h3>
                </div>
                <div class="">
                    <a href="{{url('login')}}"><button class="btn btn-primary"><i class="fa fa-list"></i>Login</button></a>
                </div>
            </div>
            


        <div id="fordata"></div>
            <hr class="my-1">
            <form action="javascript:void(0)" method="post" >
                @csrf
                <div class="row">
                    <div class="col">
                      <label for="">Name</label>
                      <input type="text" name="name" requried id="name" class="form-control" placeholder="Enter name here..">  
                         <p class="name"></p>   
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      <label for="">email</label>
                      <input type="text" name="detail" requried id="email" class="form-control" placeholder="Enter email here..">
                      <p class="email"></p>   

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      <label for="">Password</label>
                      <input type="password" name="detail" requried id="password" class="form-control" placeholder="Enter password here..">
                      <p class="password"></p>   
                    </div>
                </div>
          
                <div class="my-2">
                <button type="submit" class="btn btn-success w-100" onclick="storedata()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

<script>
function storedata()
{
   var name=$('#name').val();
   var email=$('#email').val();
   var password=$('#password').val();


   if(name=='' && email=='' && password=='')
   {
    return $('.user').html("<div class='alert alert-warning name' role='alert'>Plaese Fill all fields of the form<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>")
   }

   $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            Accept : "application/json"
                        },
                url: "{{ route('register') }}",
                type: 'post',
                data: { 
                    name: name,
                    email:email,
                    password:password
                },
                success: function(response)
                {
                    if(response.error)
                    {
                        $('#fordata').html("<div class='alert alert-warning alert-dismissible fade show'><strong>Warning!</strong>"+response.data+"</div>") 
                    }
                    else{
                        window.location = response.redirect_location;
                    }                    
                }
            });
}

</script>