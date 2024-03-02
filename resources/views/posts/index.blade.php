<x-layout>
    <!-- @ extends ('layout') taking the code from the layout.blade.php file (usually the head content like stylesheets) -->

    @include ('posts._header')

    
        
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            @if ($posts->count())
                <x-posts-grid :posts="$posts" />

                {{ $posts->links()}}
            @else
                <p class="text-center">No posts yet. Please check back later.</p>
            @endif
        </main>
</x-layout>