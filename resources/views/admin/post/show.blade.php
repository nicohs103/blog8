<x-app-layout>
    <x-slot name="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('NEW POST') }}
        </h2>
    </x-slot>

    @include('flash::message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{ Form::open(['url' => 'admin/post', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form-post']) }}

                @csrf

                <div class="form-row">
                    <div class="col-md-8">
                        <div class="position-relative form-group">
                            {!! Form::label('title', ucwords(trans('blog.title')) . ':') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="position-relative form-group">
                            {!! Form::label('description', ucwords(trans('blog.description')) . ':') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 30, 'id' => 'description', 'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-12 text-right">
                    {!! Form::submit(ucwords(trans('blog.save')), ['class' => 'btn btn-primary', 'name' => 'submitbutton', 'value' => 'save']) !!}
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });
            }); // End document ready
        </script>
    </x-slot>

</x-app-layout>
