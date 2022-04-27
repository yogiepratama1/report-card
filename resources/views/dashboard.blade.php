<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="container mx-auto px-4 sm:px-8">
                        <form action="/generate" method="POST" class="mb-3">
                            @csrf
                            <input type="number" name="jumlah" class="shadow-sm border-gray-300 rounded-lg m-2 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" placeholder="Masukan jumlah yang ingin digenerate"></input>
                            <button type="submit" class="rounded bg-blue-500 hover:bg-blue-700 py-2 px-4 text-white">
                                Generate Random Report
                            </button>
                        </form>
                        <form action="/calculate" class="mb-3">
                            @csrf
                            <button class="rounded bg-green-500 hover:bg-green-700 py-2 px-4 text-white"> Calculate Final</button>
                        </form>
                        <form action="/calculate/grade" class="mb-3">
                            @csrf
                            <button class="rounded bg-red-500 hover:bg-red-700 py-2 px-4 text-white">Calculate Grade</button>
                        </form>
                        <form action="/fill">
                            @csrf
                            <button class="rounded bg-purple-500 hover:bg-red-700 py-2 px-4 text-white">Fill Blank UAS</button>
                        </form>
                        <form action="/count" method="POST" class="mb-3">
                            @csrf
                            <input type="text" name="text" id="text" class="shadow-sm border-gray-300 rounded-lg m-2 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" placeholder="TEXT1" oninput="this.value=this.value.toLowerCase()"></input>
                            <input type="text" name="text2" id="text2" class="shadow-sm border-gray-300 rounded-lg m-2 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" placeholder="TEXT2" oninput="this.value=this.value.toLowerCase()"></input>
                            <button type="submit" class="rounded bg-blue-500 hover:bg-blue-700 py-2 px-4 text-white">
                                Check same characters between text 1 and text 2
                            </button>
                        </form>
                        @if(session()->has('success'))
                        <div class=" text-center">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="py-8">
                            <div>
                                <h2 class="text-2xl font-semibold leading-tight">Report Card</h2>
                            </div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    No
                                                </th>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Harian
                                                </th>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    UTS
                                                </th>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    UAS
                                                </th>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Final
                                                </th>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Grade
                                                </th>
                                                <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $report)
                                            <tr>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $report->harian }}
                                                </td>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $report->uts }}
                                                </td>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $report->uas }}
                                                </td>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $report->final }}
                                                </td>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{ $report->grade }}
                                                </td>
                                                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <a href="/dashboard/{{ $report->id}}/edit" class="btn btn-primary btn-sm"><button class="mb-2 rounded bg-blue-500 hover:bg-blue-700 py-2 px-4 text-white">Edit</button></a>
                                                    <form action="/dashboard/{{ $report->id }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="rounded bg-red-500 hover:bg-red-700 py-2 px-4 text-white" onclick="confirm('delete?');">DELETE</button>
                                                    </form>
                                                </td>
                                            <tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        element.addEventListener('input', function() {
            this.value = this.value.toLowerCase()
        });
    </script>
</x-app-layout>