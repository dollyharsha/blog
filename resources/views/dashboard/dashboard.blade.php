@extends('layouts.master')

@section('content')
   <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Create Your Blogs</h1>
                        <ol class="breadcrumb mb-4">
                        </ol>


<div id="userdata"></div>
<div id="alertdata"></div>


                        <div class="card mb-4">
                            <div class="card-header">
                                Blogs
                            </div>
                            <div class="card-body">
                                  <!-- create form inside here -->
                                  <form action="javascript:void(0)" method="post" >
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                <label for="">Title</label>
                                                <input type="text" require name="title" id="title" class="form-control" placeholder="Enter name here..">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                <label for="">Blog</label>
                                                <input type="text" require name="blog" id="blog" class="form-control" placeholder="Enter detail here..">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                <label for="">Blog Image</label>
                                                <input type="file" require name="blog_image" id="blog_image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="my-2">
                                            <button type="submit" onclick="storedata()" class="btn btn-success w-100" >Submit</button>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </main>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script>

function storedata()
{
   var title=$('#title').val();
   var blog=$('#blog').val();
   var files = $('#blog_image')[0].files;
  
               if(files.length > 0){
                     var fd = new FormData();

                     fd.append('blog_image',files[0]);
                     fd.append('title',title);
                     fd.append('blog',blog);
               }
                  $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        contentType: false,
                        cache: false,
                        url: "{{ route('createblog') }}",
                        type: 'post',
                        data: fd,
                    success: function(response)
                    {
                        console.log(response);
            
                        if(response.error)
                        {
                            console.log(response)
                                    
                                    $('#userdata').html("<div class='alert alert-warning alert-dismissible fade show'> <strong>Warning!</strong>"+response.data+" <button type='button' class='btn-close' data-bs-dismiss='alert'></button> </div>")    
                        }
                        else{
                         $('#title').val('');
                        $('#blog').val('');
                        $('#blog_image').empty();
                        window.location = response.redirect_location;

                        }
                    }
                });



} 

</script>
