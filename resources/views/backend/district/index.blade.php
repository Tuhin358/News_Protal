@extends('admin.admin_master')
@section('admin.content')


<style>
    .container-fluid .card .h1{
        margin-left: 14px;
    }

</style>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Districts</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @php
                        Alert::toast($error,'error')
                    @endphp
                @endforeach
            @endif

            <div class="text-end ml-4">
                <a href="{{ route('district.create') }}" class="btn btn-success">
                    {{--  {{ route('district.create') }}  --}}
                   + Add New
                </a>
            </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1">Districts </i>

                    </div>

                    <form id="frm-example" action="" method="POST">
                        @csrf
                    <div class="card-body">
                        <table class="table" >
                            {{--  id="datatablesSimple_sample" class="display " cellspacing="0" width="100%" data-mdb-selectable="true" data-mdb-multi="true"  --}}
                            <thead>
                            <tr>
                            <tr>
                                <th>S/N</th>
                                <th>English Name</th>
                                <th>Bangla Name</th>
                                <th>Action</th>
                            </tr>

                            </tr>
                            </thead>

                            <tbody >
                                  @foreach ($districts as $key=>$district)
                                <tr>
                                    <td>{{$key+1 }} </td>
                                    <td>{{$district->district_en }} </td>
                                    <td>{{$district->district_bn }} </td>
                                    <td>

                                        <a href="{{route('district.edit',$district->id) }}" class="btn-secondary btn">Edit</a>
                                        {{--  {{route('district.edit',$district->id) }}  --}}
                                        <a href="{{route('district.destroy',$district->id) }} " class="btn-danger btn onconfirmDelete" onclick="return confirm('Are you sure?')">Delete</a>
                                       {{--  <div href=" " type="submit" class="btn-danger btn " >Delete</div>  --}}
                                       {{--  {{route('district.destroy',$district->id) }}  --}}
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
