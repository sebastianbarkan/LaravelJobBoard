<x-layout>
    <x-card class="p-10">
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage Applications
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($applications->isEmpty())
                @foreach($applications as $application)

                <tr class="border-gray-300">
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="/listings/{{$application->id}}">
                            {{$application->title}}
                        </a>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                    <form method="POST" action="/applications/{{$application->id}}}">
                        @csrf
                        @method("DELETE")
                        <button class="text-red-500">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                   <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No Applications Found</p>
                   </td>
                </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>