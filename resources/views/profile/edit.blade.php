@extends('layouts.app')

@section('content')
<section class="py-10 min-h-screen">
    <div class="max-w-xl mx-auto px-4">

        <div class="bg-white rounded-3xl p-8 shadow-lg border border-neutral-100">
            <h2 class="text-2xl font-bold mb-6">
                Edit Profil
            </h2>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">
                        Username
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full border border-neutral-300 rounded-xl p-3"
                    >
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="bg-primary text-white px-6 py-3 rounded-xl font-semibold"
                    >
                        Simpan
                    </button>

                    <a
                        href="/profil"
                        class="bg-neutral-200 px-6 py-3 rounded-xl font-semibold"
                    >
                        Batal
                    </a>
                </div>
            </form>

        </div>

    </div>
</section>
@endsection