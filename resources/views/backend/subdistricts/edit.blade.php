@extends('admin.admin_master')
@section('admin.content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>Sub-Districts </b> </h1>
            {{--  @if ($errors->any())
                @foreach ($errors->all() as $error)

                @endforeach
            @endif  --}}
                <div class="row">
                    <form action="{{route('subdistrict.update',$subdistricts->id) }} " method="post" >
                        {{--  {{route('subdistrict.update') }}  --}}
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Subdistrict Name English</label>
                        <input type="text" class="form-control" id="english" aria-describedby="emailHelp" name="subdistrict_en" placeholder="Enter English Name"  value="{{ $subdistricts->subdistrict_en}}"  required="" >

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Subdistrict Name Bangla</label>
                        <input type="text" class="form-control" id="bangla" aria-describedby="emailHelp" name="subdistrict_bn" placeholder="Enter Bangla Name"  value="{{ $subdistricts->subdistrict_bn}}"  required="" >

                    </div>

                    <div class="control-group">
                        <label class="control-label">Select District</label>
                        <div class="control">
                            <select name="district_id" style="margin-left: 20px">
                                <option>Select District</option>

                                @foreach ($districts as $district)

                                <option value="{{$district->id }}">{{$district->district_en}}|{{$district->district_bn }}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                        <button type="submit" class="btn btn-primary ">Update</button>
                    </form>
                </div>

        </div>
    </main>
    <script>
        photo.onchange = evt => {
            const [file] = photo.files
            if (file) {
                blah.style = 'display:block',
                    blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
