@extends('admin.admin_master')
@section('admin.content')


<style>
    .container-fluid .card .h1{
        margin-left: 14px;
    }

</style>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sub-Districts</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @php
                        Alert::toast($error,'error')
                    @endphp
                @endforeach
            @endif

            <div class="text-end ml-4">
                <a href="{{ route('subdistrict.create') }}" class="btn btn-success">
                    {{--  {{ route('subdistrict.create') }}  --}}
                   + Add New
                </a>
            </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1">Sub-Districts </i>

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
                                <th>District</th>
                                <th>English Name</th>
                                <th>Bangla Name</th>
                                <th>Action</th>
                            </tr>

                            </tr>
                            </thead>

                            <tbody >
                                  @foreach ($subdistricts as $key=>$subdistrict)
                                <tr>
                                    <td>{{$key+1 }} </td>
                                    <td>{{$subdistrict->district->district_en }} </td>
                                    <td>{{$subdistrict->subdistrict_en }} </td>
                                    <td>{{$subdistrict->subdistrict_bn }} </td>

                                    <td>

                                        <a href="{{route('subdistrict.edit',$subdistrict->id) }}" class="btn-secondary btn">Edit</a>
                                        {{--  {{route('subdistrict.edit',$district->id) }}  --}}

                                        <a href="{{route('subdistrict.destroy',$subdistrict->id)}}" class="btn-danger btn onconfirmDelete" onclick="return confirm('Are you sure?')">Delete</a>
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
