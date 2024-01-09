<script>
import {track} from "@vue/reactivity";
import {tag} from "postcss-selector-parser";
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'TrackView',
    methods: {tag, track},
    components: {
        MusicLayout,
        Link,
    },
    props:{
        tracks:Array,
    },
    data() {
        return {
            search: '',
            audio: null,
            currentTrack: null,
        }
    },
    computed: {
        filteredTracks() {
            return this.tracks.filter((track) => {
                return track.title.toLowerCase().includes(this.search.toLowerCase())
                || track.artist.toLowerCase().includes(this.search.toLowerCase());
            });
        }
    },
    methods: {
        play(track) {
            const url = '/storage/' + track.music;

            if(!this.currentTrack) {
                this.audio = new Audio(url);
                this.audio.play();
            } else if (this.currentTrack !== track.uuid) {
                this.audio.pause();
                this.audio.src = url;
                this.audio.play();
            } else if (!this.audio.paused) {
                this.audio.pause();
            } else {
                this.audio.play();
            }

            this.currentTrack = track.uuid;
            this.audio.addEventListener('ended', () => {
                this.currentTrack = null;
            })
        }
    },

}

</script>

<template>
    <MusicLayout>
        <template #title>
           musique
        </template>
        <template #action>
            <Link 
            :href="route('tracks.create')">
                Créer une musique
            </Link>
        </template>
        <template #content>
            <div>
                <input type="search" placeholder="Rechercher une musique" v-model="search" class="border border-gray-400 p-2 mb-4" name="search" id="search">
            </div>
            <div>
                <ul >
                    <div class="grid grid-cols-4 gap-4">
                        <div
                        v-for="track in filteredTracks"
                        :key="track.uuid"
                        @click="play(track)"
                        class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer"
                        :class="{'bg-blue-500': currentTrack === track.uuid}"
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
                        </div>
                    </div>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>

<style scoped>
    ul{
        list-style: none;
        padding: 0;
    }
    li{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ccc;
        padding: 10px;
    }
    li:hover{
        background: #eee;
        cursor: pointer;
    }
    h3{
        margin: 0;
    }
    p{
        margin: 0;
    }



</style>