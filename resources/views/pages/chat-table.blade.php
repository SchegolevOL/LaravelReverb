<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Users') }}
        </h2>
    </x-slot>







    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex flex-col">
                        <div class=" overflow-x-auto">
                            <div class="min-w-full inline-block align-middle">
                                <div class="relative  text-gray-500 focus-within:text-gray-900 mb-4">
                                    <div class="absolute inset-y-0 left-1 flex items-center pl-3 pointer-events-none ">
                                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round" />
                                            <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                                            <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <input type="text" id="default-search" class="block w-80 h-11 pr-5 pl-12 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Search for company">
                                </div>
                                <div class="overflow-hidden ">
                                    <table class=" min-w-full rounded-xl">

                                        <thead>
                                        <tr class="bg-gray-50">

                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> # </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> User ID </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Name </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Email </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl"> Actions </th>
                                        </tr>

                                        </thead>
                                        @foreach($users as $user)
                                        <tbody class="divide-y divide-gray-500 ">
                                        <tr class="bg-white transition-all duration-500 hover:bg-blue-100">

                                            <td class="p-5whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{$loop->index+1}}</td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{$user->id}}</td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{$user->name}}</td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{$user->email}}</td>
                                            <td class=" p-5 ">
                                                <div class="flex items-center gap-1">
                                                    <a href="{{route('users.chat', $user->id)}}" class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                        <svg width="31px" height="31px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13.5 3H10.5C7.21252 3 5.56878 3 4.46243 3.90796C4.25989 4.07418 4.07418 4.25989 3.90796 4.46243C3 5.56878 3 7.21252 3 10.5V14.6667C3 16.5076 4.49238 18 6.33333 18H6.5C7.32843 18 8 18.6716 8 19.5C8 20.118 8.70557 20.4708 9.2 20.1L11 18.75C11.4623 18.4033 11.6934 18.23 11.9584 18.1296C12.0086 18.1106 12.0595 18.0936 12.111 18.0787C12.3833 18 12.6722 18 13.25 18H13.5C16.7875 18 18.4312 18 19.5376 17.092C19.7401 16.9258 19.9258 16.7401 20.092 16.5376C21 15.4312 21 13.7875 21 10.5C21 7.21252 21 5.56878 20.092 4.46243C19.9258 4.25989 19.7401 4.07418 19.5376 3.90796C18.4312 3 16.7875 3 13.5 3Z" stroke="#2d05f5" stroke-width="null" class="my-path"></path>
                                                            <path d="M7 8H17" stroke="#2d05f5" stroke-width="null" stroke-linecap="round" class="my-path"></path>
                                                            <path d="M7 12H12" stroke="#2d05f5" stroke-width="null" stroke-linecap="round" class="my-path"></path>
                                                        </svg>
                                                    </a>

                                                    <span id="unread-count-{{$user->id}}"
                                                          class="{{$user->unread_messages_count>0?'top-0 right-11 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full':''}}" >
                                                        {{$user->unread_messages_count>0?$user->unread_messages_count:''}}
                                                    </span>

                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




</x-app-layout>
<script type="module">
    window.Echo.private('unread-channel.{{auth()->user()->id}}').listen('UnreadMessageEvent', (event)=>{

        const unreadElementCount = document.getElementById(`unread-count-${event.senderId}`);
        if (unreadElementCount){
            unreadElementCount.classList =  event.unreadMessagesCount > 0 ? 'top-0 right-11 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full':'';
            unreadElementCount.textContent = event.unreadMessagesCount > 0 ? event.unreadMessagesCount : '';
        }

        //Play notification audio
        if(event.unreadMessagesCount > 0){
            const audio = new Audio('{{asset('sounds/helium.mp3')}}');
            audio.play();
        }


    });
</script>
