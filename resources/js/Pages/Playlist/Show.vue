<template>
    <MusicLayout>
        <template #title>
            Playlist: {{ playlist.title }}
            <Link 
            :href="route('playlists.index')" class="bg-blue-500 text-white font-bold py-2 px-4">
                Retour
            </Link>
        </template>
        <template #content>
            <div class="grid grid-cols-4 gap-4">
                        <Track 
                        v-for="track in playlist.tracks"
                        :key="track.uuid" 
                        :track="track"
                        :active="currentTrack === track.uuid"
                        @played="play"
                        />
                    </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue'
import Track from "@/Components/Track/Track.vue";

export default {
    components: {
        MusicLayout,
        Track,
    },
    props: {
        playlist: Object,
    },
}
</script>
