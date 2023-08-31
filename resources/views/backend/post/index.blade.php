@extends('admin.admin_master')
@section('admin.content')


<style>
    .container-fluid .card .h1{
        margin-left: 14px;
    }

</style>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">News Post</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @php
                        Alert::toast($error,'error')
                    @endphp
                @endforeach
            @endif

            <div class="text-end ml-4">
                <a href="{{ route('insert.post') }}" class="btn btn-success">
                   + Add New
                </a>
            </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1">News Post </i>

                    </div>

                    <div class="card-body">
                        <table class="table" >
                            {{--  id="datatablesSimple_sample" class="display " cellspacing="0" width="100%" data-mdb-selectable="true" data-mdb-multi="true"  --}}
                            <thead>
                            <tr>
                            <tr>
                                <th>N/A</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Thumbnail</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>

                            </tr>
                            </thead>

                            <tbody >
                                @foreach ($posts as $key=>$row)
                                <tr>
                                    <td>{{$key+1 }}</td>
                                    <td>{{$row->category->category_bn }}</td>
                                    <td>{{$row->subcategory->subcategory_bn}}</td>
                                    <td>{{$row->title_bd }}</td>
                                    <td>{{$row->details_bn }}</td>
                                    <td><img src="{{asset($row->image)}}" width="50px" height="70px"></td>
                                    <td>{{$row->post_date }}</td>


                                    <td>

                                        <a href="{{route('post.edit',$row->id) }} " class="btn-secondary btn">Edit</a>
                                        {{--  {{route('post.edit',$subcategory->id) }}  --}}
                                        {{--  <a href=" " class="btn-danger btn onconfirmDelete" onclick="return confirm('Are you sure?')">Delete</a>  --}}
                                        <a href="{{ route('post.destroy',$row->id) }}" type="button" class="btn-danger btn onconfirmDelete"onclick="return confirm('Are you sure?')" >Delete</a>
                                        {{--  {{ route('post.destroy',$subcategory->id) }}  type="button" --}}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    </form>
                </div>

        </div>
    </main>

<!-- Modal -->

    <script>
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.style = 'display:block',
                    blah.src = URL.createObjectURL(file)
            }
        }
    </script>




@endsection
