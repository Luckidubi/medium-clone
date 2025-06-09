@auth

<div x-data="{

    count: {{$post->claps()->count()}},
    hasClapped: {{ auth()->user()->hasClapped($post) ? 'true' : 'false' }},
    clap() {
        axios.post('/clap/{{ $post->id }}')
            .then(response => {
                this.hasClapped = !this.hasClapped;
                this.count = response.data.clap_count
            })
            .catch(error => {
                console.log('error');
            });
    }
}" class="mt-6 border-b border-gray-200 pb-6">

<button  @click="clap()" class="flex gap-1 text-sm items-center text-gray-600 hover:text-gray-800">
    <template x-if="!hasClapped">
        <img src="{{ asset('clap.svg') }}" alt="Clap"
            class="inline-block w-6 h-6 mr-1 align-middle hover:scale-110 transition-transform opacity-60">
    </template>
    <template x-if="hasClapped">
        <img src="{{ asset('clap-filled.svg') }}" alt="Clap"
            class="inline-block w-6 h-6 mr-1 align-middle hover:scale-110 transition-transform opacity-60">
    </template>

    <span x-text="count" class="font-semibold">

    </span>
</button>

</div>
@endauth