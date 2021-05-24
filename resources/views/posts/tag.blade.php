<x-app-layout>
    <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl text-gray-600 font-bold text-center uppercase">Etiqueta: {{$tag->name}}</h1>
        @foreach ($posts as $post)
        {{-- Vinculo el componente card-post.blade.php y le paso la variable $post para enviarle los datos del foreach --}}
          <x-card-post :post="$post" />
        @endforeach
        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>