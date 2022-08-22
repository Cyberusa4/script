@php
    $directFileToBig = lang('file is too big max file size: {{maxFilesize}}MiB.', 'upload zone');
    $dictResponseError = lang('Server responded with {{statusCode}} code.', 'upload zone');
@endphp
<script>
    "use strict";
    const dropzoneOptions = {
        dictDefaultMessage: "{{ lang('Drop files here to upload', 'upload zone') }}",
        dictFallbackMessage: "{{ lang('Your browser does not support drag and drop file uploads.', 'upload zone') }}",
        dictFallbackText: "{{ lang('Please use the fallback form below to upload your files like in the olden days.', 'upload zone') }}",
        dictFileTooBig: "{{ $directFileToBig }}",
        dictInvalidFileType: "{{ lang('You cannot upload files of this type.', 'upload zone') }}",
        dictResponseError: "{{ $dictResponseError }}",
        dictCancelUpload: "{{ lang('Cancel upload', 'upload zone') }}",
        dictCancelUploadConfirmation: "{{ lang('Are you sure you want to cancel this upload?', 'upload zone') }}",
        dictRemoveFile: "{{ lang('Remove file', 'upload zone') }}",
        dictMaxFilesExceeded: "{{ lang('You can not upload any more files.', 'upload zone') }}",
    };
</script>
