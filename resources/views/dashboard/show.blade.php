@extends('layouts.master')

@section('content')
   <main>
                    <div class="container-fluid px-4">
                        <!-- <h4 class="mt-4">All Blogs</h4> -->
                        <ol class="breadcrumb mb-4">
                        </ol>


                         <div id="user-success"></div>


                        <div class="card mb-4">
                            <div class="card-header">
                            All Blogs
                            </div>
                            <div class="card-body">
                         
                            <div id="editEmployeeModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit blogs</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <p id="ddd"></p>
                                                <form action="#" method="post" id="formId" enctype="multipart/form-data">
                                                @csrf 
                                                @method('patch')
                                                <div class="modal-body edit_employee">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter name here..">

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Blog</label>
                                                        <input type="text" name="blog" id="blog" class="form-control" placeholder="Enter detail here..">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <img id="image" src="" width="70px" height="70px" alt="Image">
                                                        <input type="file" name="blog_image" id="blog_image" class="form-control">
                                                    </div>
                                                    <input type="hidden" id="GetId">
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                    <input type="submit" class="btn btn-info"  value="Save">
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  </form>
<!-- </form> -->

 <!-- Delete Modal HTML -->
 <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <input type="hidden" id="delete_id">
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Blog</th>
                <th>Date</th>
                <th>slug</th>
                <th>Image</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
           
        @foreach($allblogs as $blog)   
      <tr>
        <td>1</td>
        <td>{{$blog->title}}</td>
        <td>{{$blog->blog}}</td>
        <td>{{ \Carbon\Carbon::parse($blog->blog_date)->toDayDateTimeString() }}</td>
        <td>{{$blog->slug}}</td>
        <td><img src="{{ asset($blog->blog_image) }}" width="70px" height="70px" alt="Image"></td>
        <td>
        <button type="button" onclick='OnEdit("{{$blog->slug}}")'  class="btn btn-primary">Edit</button>
        <button type="button" onclick='OnUserDelete("{{$blog->slug}}")'  class="btn btn-danger">Delete</button>

        @if($blog->is_publish==0)
        <button type="button" onclick='Onpublish("{{$blog->slug}}")'  class="btn btn-info">Publish</button>
        @else
        <button type="button" onclick='Onpublish("{{$blog->slug}}")'  class="btn btn-success">BlogPublished</button>
        @endif
        </td>
      </tr>
        
      @endforeach
        </tbody>
    </table>

    {!! $allblogs->links() !!}

    <!-- {{$allblogs->render()}} -->



                            </div>
                        </div>
                    </div>
                </main>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>
<script>

function OnEdit(slug)
{
    var slug=slug;
    var url = "{{url('blog/edit')}}"+"/"+slug;

            $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                            url:url,
                            type: 'get',
                            success: function(response)
                            {
                                // console.log(response)
                            
                                $('#editEmployeeModal').modal('show');
                                
                                $('.edit_employee #title').val(response.editdata.title);
                                $('.edit_employee #blog').val(response.editdata.blog); 
                                var image=response.editdata.blog_image
                                var slug=response.editdata.slug


                               $('.edit_employee #image').attr("src", response.projectUrl+"/"+image);

                               $('.edit_employee #GetId').val(response.editdata.id);
                               $('#formId').attr('action', response.projectUrl+"/blog/update/"+slug);
                            
                            }
                        });
}

function OnUserDelete(slug)
{
    var slug=slug;
    var url = "{{url('blog/delete')}}"+"/"+slug;

     $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url:url,
                type: 'delete',
                success: function(response)
                            {
                                console.log(response)

                                    if(response)
                                    {
                                        // $('#deleteEmployeeModal').modal('hide'); 
                                        
                             window.location = response.redirect_location;
                                    }
                        
                            }

    });

} 
function Onpublish(slug)
{
    var slug=slug;
    var url = "{{url('blog/publish')}}"+"/"+slug;

            $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                            url:url,
                            type: 'put',
                            success: function(response)
                            {
                                window.location = response.redirect_location;
                            
                            }
                        });
}
</script>

