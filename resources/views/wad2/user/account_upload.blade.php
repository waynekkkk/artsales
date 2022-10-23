@extends('layouts.app')

@section('content')
    <body>
        <!-- Upload -->
        <h2 class="text-center mb-3">
            Upload your amazing artworks here!
        </h2>

        <div id="uploadfile"> 
            <form id="file-upload-form" class="uploader">
                <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
              
                <label for="file-upload" id="file-drag">
                  <img id="file-image" src="#" alt="Preview" class="hidden">
                  <div id="start">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <div>Select a file or drag here</div>
                    <div id="notimage" class="hidden">Please select an image</div>
                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                  </div>
                  <div id="response" class="hidden">
                    <div id="messages"></div>
                    <progress class="progress" id="file-progress" value="0">
                      <span>0</span>%
                    </progress>
                  </div>
                </label>
              </form>
        </div>

        <script src="upload.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>


@endsection