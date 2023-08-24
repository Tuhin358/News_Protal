@extends('admin.admin_master')
@section('admin.content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>SubCategories </b> </h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @php
                        Alert::toast($error,'error')
                    @endphp
                @endforeach
            @endif
                <div class="row">
                    <form action="{{route('subcat.store') }}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">SubCategory Name English</label>
                        <input type="text" class="form-control" id="english" aria-describedby="emailHelp" name="subcategory_en" placeholder="Enter English Name" required="" >

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">SubCategory Name Bangla</label>
                        <input type="text" class="form-control" id="bangla" aria-describedby="emailHelp" name="subcategory_bn" placeholder="Enter Bangla Name" required="" >

                    </div>

                    <div class="control-group">
                        <label class="control-label">Select Category</label>
                        <div class="control">
                            <select name="category_id" style="margin-left: 20px">
                                <option>Select Category</option>

                                @foreach ($categories as $category)

                                <option value="{{$category->id }}">{{$category->category_en}}|{{$category->category_bn }}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                        <button type="submit" class="btn btn-primary ">Submit</button>
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
