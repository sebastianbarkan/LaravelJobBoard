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
           <div class="border border-gray-200 w-full mb-6 mt-6"></div>
        <div>
            <h3 class="text-3xl font-bold mb-4">
                Apply Now!
            </h3>
            <div class="text-lg space-y-6">
              <form action="/listings/{id}/apply" method="POST">
                @csrf
                <div class="mb-6">
                    <label
                        for="name"
                        class="inline-block text-lg mb-2"
                    >
                        What's your name?
                    </label>
                    <input
                        class="border border-gray-200 rounded p-2 w-full"
                        name="name"
                        placeholder="Enter your full name..."
                        type="text"
                    >
                    {{old("name")}}
                    @error("name")
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="resume" class="inline-block text-lg mb-2">
                        Resume
                    </label>
                    <input
                        type="file"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="resume"
                    />
                    @error("resume")
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label
                        for="comments"
                        class="inline-block text-lg mb-2"
                    >
                        Is there anything else you'd like to tell us?
                    </label>
                    <textarea
                        class="border border-gray-200 rounded p-2 w-full text"
                        name="comments"
                        rows="8"
                        placeholder="Describe what makes you stand out..."
                    ></textarea>
                    @error("comments")
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                
            

              </form>
            </div>
        </div>
    </div>
 </x-card>
  <div class="border border-gray-200 w-full mb-6"></div>
 <x-card class="flex flex-col items-center justify-center text-center gap-y-4">
   <h2 class="text-center text-2xl font-bold">Reviews</h2>
    <form method="POST" action="/reviews/{{$listing->id}}" class="flex flex-col items-center gap-y-2">
            @csrf
            <textarea class="border border-gray-500 p-4" name="review" placeholder="Leave a review..."></textarea>
            @error("review")
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <button type="submit" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Leave Review</button>
    </form>
   
   <div class="flex flex-col items-center gap-y-4 mt-4">
        @foreach($reviews as $review)
            <div class="flex flex-col items-center bg-white p-4 border border-gray-500 rounded">
                <p class="text-center font-bold">{{$review->review}}</p>
                <p class="italic">{{$review->created_at->diffForHumans()}}</p>
                <p>{{$review->name}}</p>
            </div>
        @endforeach 
   </div>
   <div>
    {{$reviews->links()}}
   </div>
</x-card>
</div>

</x-layout>