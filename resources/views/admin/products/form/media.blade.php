@push('css')
  <link rel="stylesheet" href="{{ url('assets/css/dropzone.min.css') }}" />
  <style>
    .dropzone .dz-preview .dz-progress {
      opacity: 0;
    }
    :root {
        --main-transition: all 0.5s;
    }
    #drop_zone {
        font-family: monospace;
        min-height: 200px;
        position: relative;
        box-shadow: 1px 1px 7px black;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5%;
        row-gap: 10px;
    }
    #drop_zone::after {
    content: attr(data-defaultMsg);
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    color: white;
    z-index: 2;
    }
    #drop_zone::before, #drop_zone div::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: #00000082;
    transition: var(--main-transition);
    z-index: 1;
    }
    #drop_zone::before {
    z-index: 2;
    }
    #drop_zone:hover:before, #drop_zone:hover:after, #drop_zone div::before {
    opacity: 0;
    visibility: hidden;
    }

    #drop_zone div {
    height:250px;
    display: flex;
    flex-direction: column;
    text-align: center;
    width: 33%;
    position: relative;
    overflow: hidden;
    justify-content: center;
    }

    #drop_zone div:hover:before {
    opacity: 1;
    visibility: visible;
    }

    #drop_zone div img {
    width:100%;
    height:100%;
    cursor: pointer;
    transition: var(--main-transition);
    }

    #drop_zone div:hover img{
    transform: scaleX(1.2);
    }

    #drop_zone div a {
    cursor: pointer;
    position: absolute;
    right: 0;
    top: 0;
    z-index: 1;
    background: #585858;
    color: #fd5252;
    padding: 5px 8px;
    border-radius: 3px;
    text-decoration: none;
    transition: var(--main-transition);
    opacity: 0;
    font-weight: bold;
    font-size: 25px;
    }

    #drop_zone div span {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background: #585858;
    color: #fff;
    padding: 8px;
    border-radius: 3px;
    opacity: 0;
    transition: var(--main-transition);
    z-index: 1;
    word-break: break-word;
    width: fit-content;
    }

    #drop_zone div:hover span, #drop_zone div:hover a {
    opacity: 1;
    }

    #drop_zone_errorMsgs {
    color: #fff;
    background-color: #dc3545;
    border-color: #d32535;
    position: relative;
    padding: 0.75rem 1.25rem;
    position: absolute;
    left: 0;
    right: 0;
    z-index: 3;
    border: 1px solid transparent;
    border-radius: 0.25rem;

    transition: var(--main-transition);
    }
    .drop_zone_errorMsgs--show {
        visibility: visible;
        opacity: 1;
        transition: var(--main-transition);
    }
    .drop_zone_errorMsgs--remove {
        visibility: hidden;
        opacity: 0;
        transition: var(--main-transition);
    }
  </style>
@endpush

<div id="media" class="container tab-pane fade"><br>
  {!! Form::file('photo', ['class' => 'form-control', 'id' => 'photo']) !!}
  @if (!empty($product->photo))
    <img src="{{ asset('storage/' . $product->photo) }}" style="width: 50px;height: 50px;" />
  @endif
  <div id="drop_zone" data-defaultMsg="Drag one or more files to this Drop Zone ..."></div>
    @php
        $path = '';
        $filesID = '';
        if(isset($product)){
            foreach ($product->files as $file) {
                $path .= asset('storage/' . $file->full_file).'||';
                $filesID .= $file->id.'||';
            }
            $path = rtrim($path, "||");
        }
    @endphp
</div>
@push('js')
  <script src="{{ url('assets/js/dropzone.min.js') }}"></script>
  <script>
    var ext = ['jpeg', 'jpg', 'png', 'gif', 'ico', 'icon', 'bmp', 'webp', 'psd', 'ai', 'raw', 'heif', 'indd', 'eps','jpe' ,'jif', 'jfif', 'jfi'];
    dropZone({
        paramName: 'sub_files',
        multiple: true,
        maxFiles: 6,
        maxFileSize: 2 * 1024 * 1024, //MB
        addDownloadinks: true,
        addRemoveLinks: true,
        addFileName: true,
        addFileSize: true,
        acceptedFiles: ext,
        customeMaxFilesMsg: 'You can\'t upload more than 6 files',
        customeMaxFileSizeMsg: 'Sorry, but max file size must be 2MB',
        customeAcceptedFilesMsg: 'Sorry, but allowed extensions are ',
        oldFilesPath: "{{ $path }}",
        oldFilesID: "{{ $filesID }}",
        submitButtons: '.btn-success,.btn-info',
        // onUpload: function(newestFiles, drop_zone_input_files) {
        //     console.log(newestFiles, drop_zone_input_files);
        // },
        // onDelete: function(fileID, drop_zone_input_files) {
        //     console.log(fileID, drop_zone_input.files);
        // }
    });
  </script>
@endpush
