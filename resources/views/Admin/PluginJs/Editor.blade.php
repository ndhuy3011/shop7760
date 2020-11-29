<!-- Page level Editor scripts -->
<script src="{{asset('./style/vendor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'editor', {
    filebrowserUploadMethod: 'form',
    filebrowserUploadUrl: "{{route('ckeditor.upload',['_token' => csrf_token()])}}"
} );
</script>
