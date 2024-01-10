<template>
    <div
    class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer"
    :class="{'bg-blue-500': active}"
    >
        <div class="w-full h-1/2">
            <img class="w-full h-full" :src="`/storage/${track.image}`">
        </div>
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ track.title }}</div>

                <small class="text-gray-700 text-base">
                    {{ track.artist }}
                </small>
            </div>
            <button 
            class="bg-blue-500 text-white font-bold py-2 px-4" 
            @click="handleClic"
            >
                Lire
            </button>
            <div class="w-full flex justify-between">
                <Link
                v-if="$page.props.is_admin"
                :href="route('tracks.edit', {track: track})"
                class="bg-red-500 font-bold py-2 px-4 w-1/2 text-center text-white"
                >
                Modifier
                </Link>
                <Link
                v-if="$page.props.is_admin"
                :href="route('tracks.destroy', {track: track})"
                class="bg-yellow-500 font-bold py-2 px-4 w-1/2 text-center text-white"
                method="delete"
                as="button"
                >
                Supprimer
                </Link>
            </div>
        </div>
</template>

<script>
export default {
    name: 'Track',
    emits: ['played'],
    props:{
        track:Object,
        active: {
            type: Boolean,
            default: false,
        },
        
    },
    methods: {
        handleClic() {
            this.$emit('played', this.track);
        }
    },

}
</script>
