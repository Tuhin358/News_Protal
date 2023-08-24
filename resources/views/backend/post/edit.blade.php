@extends('admin.admin_master')
@section('admin.content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>  --}}

{{--  @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif  --}}


<div class="row-fluid sortable">
<div class="box span12">
    <div class="box-header" data-original-title>

        <p class="alert-success">
            @php
                $message=Session::get('message');
                if($message){
                    echo $message;
                }else{
                    Session::put('message',null);
                }
            @endphp
        </p>
        <h2><i class="halflings-icon edit "></i><span class="break"></span> Update Data </h2>

    </div>

    <div class="box-content">
        <form class="form-horizontal" action=" " method="post" enctype="multipart/form-data">
            @csrf

            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="date01">Title Bangla</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge"  name="title_bd" value="{{ $posts->title_bd }}" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Title English</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="title_en" value="{{ $posts->title_en }}" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Select Category</label>
                    <div class="control">
                        <select id="categorySelect" name="category_id" style="margin-left: 20px">
                            <option selected="" disabled=""  >==Choose One==</option>



                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Select SubCategory</label>
                    <div class="control">
                        <select id="subcategorySelect" name="subcategory_id" style="margin-left: 20px">
                            <option selected="" disabled="" >==Choose One==</option>



                    </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Select District</label>
                    <div class="control">
                        <select id="districtSelect" name="dis_id" style="margin-left: 20px">
                            <option selected="" disabled="" >==Choose One==</option>

                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Select SubDistrict</label>
                    <div class="control">
                        <select  id="subdistrictSelect" name="subdis_id" style="margin-left: 20px">
                            <option selected="" disabled="" >==Choose One==</option>


                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">File Upload</label>
                    <div class="form-group">
                        <img src="{{ asset($posts->image) }}" width="100px" height="70px">
                    </div>
                    <div class="controls">
                        <input type="file" name="image"  required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Tags Bangla</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge "  name="tags_bn" value="{{ $posts->tags_bn }}" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Tags English</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="tags_en"  value="{{ $posts->tags_en }}"  required>
                    </div>
                </div>

                <div class="control-group ">
                    <label class="control-label" for="textarea2">Details English</label>
                    <div class="controls">
                        <textarea class="textarea" name="details_en" rows="3" required>{{ $posts->details_en }}</textarea>
                    </div>

                </div>

                <div class="form-group hidden-phone">
                    <label class="control-label" for="textarea2">Details Bangla</label>
                    <div class="controls">
                        <textarea class="textarea" name="details_bn" rows="3" required>{{ $posts->details_bn }}</textarea>
                    </div>

                </div>

                <hr>
                <h4 class="text-center pt-3">Extra Option</h4>

                    <div class="form-check">
                        <input  type="checkbox"  class="form-check-input" id="exampleCheck1" name="headline" value="1">
                        <label class="form-check-label" for="exampleCheck1"> Hedline</label>
                      </div>
                      <div class="form-check">
                        <input  type="checkbox"  class="form-check-input" id="exampleCheck1" name="bigthumbnail" value="1">
                        <label class="form-check-label" for="exampleCheck1"> General Big Thumbnail</label>
                      </div>
                      <div class="form-check">
                        <input  type="checkbox"  class="form-check-input" id="exampleCheck1" name="first_section" value="1">
                        <label class="form-check-label" for="exampleCheck1"> First Section</label>
                      </div>
                      <div class="form-check">
                        <input  type="checkbox"  class="form-check-input" id="exampleCheck1" name="time_section_thumbnil" value="1">
                        <label class="form-check-label" for="exampleCheck1"> Time Section BigThumbnail</label>
                      </div>


                <div class="form-actions ">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </fieldset>
        </form>

    </div>
</div><!--/span-->
</div><!--/row-->
</div><!--/row-->

  <script>
    $(document).ready(function() {
        $('#categorySelect').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: '{{ route("get-subcategories", ":category_id") }}'.replace(':category_id', category_id),
                    //url:"{{ url('/get-subcategories/') }}/"+category_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategorySelect').empty();
                        $('#subcategorySelect').append('<option value="">Select Subcategory</option>');
                        $.each(data, function(key, value) {
                            $('#subcategorySelect').append('<option value="' + value.id + '">' + value.subcategory_bn + '</option>');
                        });
                      // console.log(data)
                    }
                });
            } else {
                alert("danger");
                //$('#subcategorySelect').empty();
                //$('#subcategorySelect').append('<option value="">Select Subcategory</option>');
            }
        });
    });
</script>
             // District section

 <script>
    $(document).ready(function() {
        $('#districtSelect').on('change', function() {
            var dis_id = $(this).val();
            if (dis_id) {
                $.ajax({
                    url: '{{ route("get-subdistricts", ":dis_id") }}'.replace(':dis_id', dis_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subdistrictSelect').empty();
                        $('#subdistrictSelect').append('<option value="">Select Subdistrict</option>');
                        $.each(data, function(key, value) {
                            $('#subdistrictSelect').append('<option value="' + value.id + '">' + value.subdistrict_bn + '</option>');
                        });
                    }
                });
            } else {
                $('#subdistrictSelect').empty();
                $('#subdistrictSelect').append('<option value="">Select Subdistrict</option>');
            }
        });
    });
</script>






@endsection




