 {{-- CREACION DE COMPONENTE CARD PARA LA VISTA POSTS --}}
 @props(['post']) 
  
  <article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
      @if ($post->image)
          <img class="w-full h-72 object-cover object-center " src="{{ Storage::url($post->image->url) }}" alt="">
      @else
          <img class="w-full h-72 object-cover object-center " src="https://i2.wp.com/www.icrisat.org/wp-content/uploads/2017/11/image-pending-_resized700x500-2.jpg" alt="">
      @endif
      <div class="px-6 py-2">
          <h1 class="font-bold text-xl mb-2">
              <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
          </h1>
          <div class="text-gray-700 text-base">
              {{ $post->extract }}
          </div>
          <div class="px-6 pt-4 pb-2">
              @foreach ($post->tags as $tag)
                  <a class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2"
                      href="{{route('posts.tag', $tag)}}">{{ $tag->name }}</a>
              @endforeach
          </div>
      </div>
  </article>
