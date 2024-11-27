<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Files Cluster') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">Upload File</h3>
                <form action="{{ route('filesCluster.upload') }}" method="POST" enctype="multipart/form-data" class="p-6 text-gray-900 dark:text-gray-100">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <button type="submit" class="button">Upload</button>
                </form>
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mb-4">List of Files</h3>
                @if ($route != "/")
                    <a href="{{ route('filesCluster') }}?action=back&path={{$route}}" class="btn btn-info">Back</a>
                @endif
                <div class="box mx-5 mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Download</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td>{{ $file->file_name }}</td>
                                <td><a href="{{ route('filesCluster.download', $file->id) }}" class="btn btn-info">Download</a></td>
                                <td>
                                    @if ($file["type"] == "FILE")
                                        {{ $file["name"] }}
                                    @else
                                        @if ($route == "/")
                                            <a href="{{ route('filesCluster') }}?path={{$route}}{{$file['name']}}">{{ $file["name"] }}</a>
                                        @else
                                            <a href="{{ route('filesCluster') }}?path={{$route}}/{{ $file['name'] }}">{{ $file["name"] }}</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        @if ($file["type"] == "FILE")
                                            <form action="{{ route('filesCluster.download') }}" method="POST" target="_blank">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="file" value="{{ $file['name'] }}">
                                                <input type="hidden" name="path" value="{{ $route }}">
                                                <button type="submit" class="btn">Download</button>
                                            </form>
                                        @endif
                                        @if ($file["type"] == "FILE")
                                            <a href="{{ route('filesCluster.delete') }}?path={{$route}}&file={{$file['name']}}" class="btn btn-error">Delete</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
