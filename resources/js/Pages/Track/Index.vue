<script>
import {track} from "@vue/reactivity";
import {tag} from "postcss-selector-parser";
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from "@inertiajs/vue3";
import Track from "@/Components/Track/Track.vue";

export default {
    name: 'TrackView',
    methods: {tag, track},
    components: {
        MusicLayout,
        Link,
        Track,
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
            :href="route('tracks.create')"
            v-if="$page.props.is_admin"
            >
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
                        <Track 
                        v-for="track in filteredTracks"
                        :key="track.uuid" 
                        :track="track"
                        :active="currentTrack === track.uuid"
                        @played="play"
                        />
                    </div>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>