@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM THƯ VIỆN ẢNH
                </header>

                <form action="{{URL::to('/insert-gallery/'.$pro_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-3" align="right">
                            
                        </div>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="files" name="images[]" accept="image/*" multiple required>
                            <span id="error_gallery">
                                
                            </span>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn-group btn btn-success">
                        </div>
                    </div>
                </form>
         
                <div class="panel-body">
                    <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                    <form enctype="multipart/form-data">
                        @csrf
                        <div id="gallery_load">
                        
                        </div>
                    </form>
                   
                </div>
            </section>

    </div>
@endsection