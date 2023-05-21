<x-layout>

<a href="/" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
    <x-card class="p-24">
    <div
        class="flex flex-col items-center justify-center text-center"
    >
        <img
            class="w-48 mr-6 mb-6"
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset("/images/no-image.png")}}"
            alt=""
        />

        <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
        
        <x-listing-tags :tagsCsv="$listing->tags"/>
        
        <div class="text-lg my-4">
            <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
        </div>
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
            <h3 class="text-3xl font-bold mb-4">
                Job Description
            </h3>
            <div class="text-lg space-y-6">
               {{$listing->description}}

                <a
                    href="mailto:{{$listing->email}}"
                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                    ><i class="fa-solid fa-envelope"></i>
                    Contact Employer</a
                >

                <a
                    href="https://test.com"
                    target="_blank"
                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                    ><i class="fa-solid fa-globe"></i> {{$listing->website}}</a
                >
            </div>
        </div>
    </div>
 </x-card>
 <x-card class="flex flex-col items-center justify-center text-center gap-y-4">
   <h2 class="text-center text-2xl font-bold">Reviews</h2>
    <form method="POST" action="/reviews/{{$listing->id}}" class="flex flex-col items-center gap-y-2">
            @csrf
            <textarea class="border border-gray-500 p-4" name="review"></textarea>
            @error("review")
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <button type="submit" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Leave Review</button>
    </form>
   
   <div class="flex flex-col items-center">
        @foreach($reviews as $review)
            <div class="flex flex-col items-center">
                <p>{{$review->review}}</p>
                <p>{{$review->created_at}}</p>
                <p>{{$review->user_id}}</p>
            </div>
        @endforeach 
   </div>
</x-card>
</div>

</x-layout>