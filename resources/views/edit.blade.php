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
                        <form action="/dashboard/{{$report->id}}/update" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="harian" class="form-label">Harian</label>
                                <input type="number" id="harian" name="harian" class="@error('harian') is-invalid @enderror form-control" value="{{old('harian', $report->harian )}}" autofocus>
                                @error('harian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="uts" class="form-label">UTS</label>
                                <input type="number" id="uts" name="uts" class="@error('uts') is-invalid @enderror form-control" value="{{old('uts', $report->uts )}}">
                                @error('uts')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="uas" class="form-label">UAS</label>
                                <input type="number" id="uas" name="uas" class="@error('uas') is-invalid @enderror form-control" value="{{old('uas', $report->uas )}}">
                                @error('uas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button class="rounded bg-blue-500 hover:bg-blue-700 py-2 px-4 text-white">Update</button>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>