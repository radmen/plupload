<ul id="{{ $prefix }}_filelist"></ul>

<div id="{{ $prefix }}_container">
    <a id="{{ $browse_button_id }}" href="javascript:;">[Browse...]</a> 
    <a id="{{ $prefix }}_start-upload" href="javascript:;">[Start Upload]</a>
</div>
<pre id="{{ $prefix }}_console"></pre>

<script type="text/javascript" src="packages/fojuth/plupload/assets/js/plupload.full.min.js"></script>
<script type="text/javascript">
var {{ $prefix }}_uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
  browse_button: '{{ $browse_button_id }}', // this can be an id of a DOM element or the DOM element itself
  container: '{{ $prefix }}_container',
  dragdrop: true,
  max_file_size : '{{ $max_file_size }}',
	url: '{{ $handler_gate }}',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap'
});

{{ $prefix }}_uploader.init();

{{ $prefix }}_uploader.bind('FilesAdded', function(up, files) {
	var html = '';
  
	plupload.each(files, function(file) {
		html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
	});
	document.getElementById('{{ $prefix }}_filelist').innerHTML += html;
});

{{ $prefix }}_uploader.bind('UploadProgress', function(up, file) {
	document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});

{{ $prefix }}_uploader.bind('Error', function(up, err) {
	document.getElementById('{{ $prefix }}_console').innerHTML += "\nError #" + err.code + ": " + err.message;
});

{{ $prefix }}_uploader.bind('FilesAdded', function(up, files) {
	var html = '';
  
	plupload.each(files, function(file) {
		html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
	});
  
	document.getElementById('filelist').innerHTML += html;
});

document.getElementById('{{ $prefix }}_start-upload').onclick = function() {
	{{ $prefix }}_uploader.start();
};
</script>