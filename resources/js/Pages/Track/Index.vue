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
                <ul >
                    <li v-for="track in tracks" :key="track.uuid">
                        <div>
                            <h3>
                                {{track.title}}
                            </h3>
                            <p>
                                {{track.artist}}
                            </p>
                        </div>
                    </li>
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