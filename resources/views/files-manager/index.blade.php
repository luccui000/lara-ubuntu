@extends('layouts.app')

@section('content')
    <div class="w-full mt-2">
        <ul class="h-12 flex justify-center items-center">
            <li class="cursor-pointer transition duration-300 hover:bg-gray-100 px-4 py-2 rounded">
                <box-icon name='folder-plus'></box-icon>
            </li>
            <li class="cursor-pointer transition duration-300 hover:bg-gray-100 px-4 py-2 rounded">
                <label for="upload-file">
                    <box-icon name='upload' ></box-icon>
                </label>
                <input type="file" id="upload-file" hidden />
            </li>
            <li class="cursor-pointer transition duration-300 hover:bg-gray-100 px-4 py-2 rounded">
                <box-icon name='cloud-download' ></box-icon>
            </li>
            <li class="cursor-pointer transition duration-300 hover:bg-gray-100 px-4 py-2 rounded">
                <box-icon name='trash' ></box-icon>
            </li>
            <li class="cursor-pointer transition duration-300 hover:bg-gray-100 px-4 py-2 rounded">
                <box-icon name='share-alt' ></box-icon>
            </li>
        </ul>
        <div class="grid grid-cols-8 gap-1">
            @foreach($directories as $directory)
                <div class="w-30 px-2 py-4 hover:shadow cursor-pointer">
                    <div class="relative">
                        <img class="w-full" src="{{ url('/images/files/folder.png') }}" alt="">
                        <img class="absolute top-16 left-12" src="{{ url('/images/files/word.png') }}" alt="">
                    </div>
                    <a class="block text-center" href="#">{{ $directory['name'] }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log(window.location.search)
        })
    </script>
@endpush
