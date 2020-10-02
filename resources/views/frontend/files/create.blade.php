@extends('frontend.layouts.app')

@section('cssTopMiddle')
    <link rel="stylesheet" href="{{ asset('/plugins/dropzone-master/dist/min/dropzone.min.css') }}" type="text/css">
@endsection

{{-- SEO Related Data --}}
@section('title', trans_choice('messages.file', 2))

{{-- In page title --}}
@section('page_title', trans_choice('messages.file', 2))

@section('content')
	<div class="row">
	  <div class="col-12">
	    <div class="card card-primary">
	      <div class="card-body">
	        <form  action="{{ route('files.store') }}" method="post" enctype="multipart/form-data" class="dropzone clickable-dropzone" id="my-awesome-dropzone">
	        	@csrf
	        	@method('POST')
	        	<div class="dz-message">
	        		{!! __('Drop files here to upload or <span class="info-upload-txt"> click to upload images.</span>') !!}
	        	</div>

            	<div class="fallback">
            		{{ __('Update your brouser in order to support Drag&amp;Drop features.') }}
            	    <input name="file" type="file" multiple />
            	</div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
@endsection

@push('afterJsScripts')
<script src="{{ asset('/plugins/dropzone-master/dist/min/dropzone.min.js') }}"></script>
<script>
	// Disable auto discover for all elements:
	Dropzone.autoDiscover = false;
	var myDropzone = null;
	(function($){
		$(document).ready(function () {
			'use strict';

			let form = $('#my-awesome-dropzone')

			// INICIALISE DROPZONE
			myDropzone = new Dropzone('#my-awesome-dropzone', {
				// url: fullBaseUrl+'/files/upload',
				url: "{{ route('files.store') }}",
				params: {
					visibility: 'private',
				},
				headers: {
				    'X-Author': "{{ config('app.author') }}"
				},
				createImageThumbnails: true,
				addRemoveLinks: true,
				autoProcessQueue: true,
				clickable: '.clickable-dropzone',
				sending: function (file, xhr, formData) {
					console.log(file, xhr, formData);
				    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
				},
			});


			myDropzone.on('dragenter', function () {
			    form.addClass("hover");
			});

			myDropzone.on('dragleave', function () {
			    form.removeClass("hover");
			});

			myDropzone.on('drop', function () {
			    form.removeClass("hover");
			});

			// Maximum file is => x <=
			myDropzone.on('maxfilesexceeded', function(file) {

			});

			// AUTOPROCESS QUEUE
			myDropzone.on('processing', function() {
				this.options.autoProcessQueue = true;
			});

			// SHOW NOTIFICATION IF MIXFILES EXEEDED
			myDropzone.on('success', function(file, response) {
				if (file.xhr.readyState == 4) {
				    if (response !== undefined && response.data !== undefined && response.data){
				        
				    }
				}
			});

			// SHOW NOTIFICATION IF ANYTHING GOES WRONG
			myDropzone.on('error', function(file, response) {
				toastr.warning('Something went wrong while trying to fetch the data from server', 'Error!');
				var _this = this;
				_this.removeFile(file);
			});

			myDropzone.on('addedfile', function(file) {
				// console.log(this.getQueuedFiles().length);
				// console.log(this.getUploadingFiles().length);
				// console.log(this.getAcceptedFiles());
			});

			// LOAD ALL IMAGES AFTER UPLOAD HAS FINISHED
			myDropzone.on('queuecomplete', function() {
				// maybe reload the data of images
				// this.listMedia();
			});


		});
	})(jQuery);
</script>
@endpush
