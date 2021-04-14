<x-guest-layout>

    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
        @endauth
    </div>
    @endif

    <p class="text-center text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-gray-900 tracking-tight mb-8">{{ config('app.name', 'Laravel') }}</p>


    <div class="max-w-lg mx-auto">
        @foreach ($lastPosts as $post)
        <div class="my-10">
            <div class="text-lg">{{ trans('blog.title') }}: {{ $post->title }}</div>
            <div class="">{{ trans('blog.description') }}: {{ $post->description }}</div>
            <div class="grid grid-cols-3 text-sm">
                <div class="text-left">{{ trans('blog.created_by') }}: {{ $post->user->name }}</div>
                <div></div>
                <div class="text-right">{{ trans('blog.publication_date') }}: {{ \Carbon\Carbon::create($post->publication_date)->format('d-m-Y H:m') }}
                </div>
            </div>
        </div>
        @endforeach

        <div class="float-right w-48">{{ $lastPosts->links() }}</div>
    </div>
</x-guest-layout>
