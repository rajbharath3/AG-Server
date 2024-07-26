@extends('layouts.app')

@section('content')
    <div ng-controller="MainController as main">
        <div class="overflow-x-auto mt-8 flex justify-center w-full m-5" style="margin:10px;">
            <div class="w-4/5">
                <table class="min-w-full bg-white mt-5">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">S.N</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Password</th>
                            <th class="py-3 px-6 text-left">Created At</th>
                            <th class="py-3 px-6 text-left">Updated At</th>
                            <th class="py-3 px-6 text-left">Actions</th> <!-- Add actions column -->
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr ng-repeat="(index, data) in main.griddata" class="bg-white shadow-md mb-4">
                            <td class="py-3 px-6 text-left whitespace-nowrap">@{{ (main.pagingData.currentPage - 1) * main.pagingData.pageSize + index + 1 }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">@{{ data.name }}</td>
                            <td class="py-3 px-6 text-left">@{{ data.email }}</td>
                            <td class="py-3 px-6 text-left">@{{ data.password }}</td>
                            <td class="py-3 px-6 text-left">@{{ data.created_at }}</td>
                            <td class="py-3 px-6 text-left">@{{ data.updated_at }}</td>
                            <td class="py-3 px-6 text-left">
                                <button class="btn btn-primary" ng-click="main.becomeUser(data.id)">
                                    <i class="fas fa-user"></i> Become User
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <jesh-paginator paging-data="main.pagingData" function-call="main.fetchGridData()"></jesh-paginator>
        </div>
        <div class="editor-wrapper">
            <div class="editor-config">
                <ace-editor></ace-editor>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('superadmin-views.users.angular.main_controller')
    <script src="{{ asset('js/components/jesh-paginator.js') }}"></script>
    <script src="{{ asset('js/components/ace-editor.js') }}"></script>
@endpush

<style>
    .editor-wrapper {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically if height is defined */
        height: 100vh; /* Adjust height as needed */
        width: 100%; /* Full width */
    }

    .editor-config {
        width: 80%; /* Width of the editor container */
        max-width: 1200px; /* Optional: Set a max-width to prevent excessive stretching */
        text-align: center;
    }

    ace-editor {
        display: block; /* Ensure ace-editor is block level for width adjustments */
    }
</style>