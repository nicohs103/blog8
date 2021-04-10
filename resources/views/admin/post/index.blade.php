<x-app-layout>
    <x-slot name="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('flash::message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table id="data-post" class="table table-hover table-striped table-bordered responsive">
                            <thead>
                                <tr>
                                    <th>{{ ucfirst(trans('blog.title')) }}</th>
                                    <th>{{ ucfirst(trans('blog.publication_date')) }}</th>
                                    <th>{{ ucfirst(trans('blog.description')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });
            });
            // End document ready

            var ruta = "{{ route('admin.post.getPostsDatatable') }}";

            var post_table = $('#data-post').DataTable({
                ajax: {
                    url: ruta,
                    type: "GET",
                    data: function(d) {},
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'publication_date',
                        name: 'publication_date'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    }
                ],
                order: [1, 'ASC']
            });
        </script>
    </x-slot>

</x-app-layout>
