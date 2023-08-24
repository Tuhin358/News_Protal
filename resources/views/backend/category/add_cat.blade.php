@extends('admin.admin_master')
@section('admin.content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Categories</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @php
                        Alert::toast($error,'error')
                    @endphp
                @endforeach
            @endif
                <div class="row">
                    <form action="{{route('cat.store') }}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name English</label>
                        <input type="text" class="form-control" id="english" aria-describedby="emailHelp" name="category_en" placeholder="Enter English Name" required="" >

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name Bangla</label>
                        <input type="text" class="form-control" id="bangla" aria-describedby="emailHelp" name="category_bn" placeholder="Enter Bangla Name" required="" >

                    </div>

                        <!-- Text input -->

                        <!-- Submit button -->
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
