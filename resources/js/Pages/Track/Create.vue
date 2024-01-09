<script>
import {track} from "@vue/reactivity";
import {tag} from "postcss-selector-parser";
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    components: {
        MusicLayout,
        Link,
    },

}

</script>

<template>
    <MusicLayout>
        <template #title>
           Créer une musique
        </template>
        <template #action>
            <Link 
            :href="route('tracks.create')">
                Créer une musique
            </Link>
        </template>
        <template #content>
        </template>
    </MusicLayout>
</template>