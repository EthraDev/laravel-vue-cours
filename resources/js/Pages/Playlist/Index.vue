<script>

import MusicLayout from '@/Layouts/MusicLayout.vue';
import {Link} from "@inertiajs/vue3";

export default {
    name: 'PlaylistView',
    components: {
        MusicLayout,
        Link,
    },
}

</script>

<template>
    <MusicLayout>
        <template #title>
            Playlists
        </template>
        <template #content>
        <Link
        :href="route('playlists.create')"
        class="bg-blue-500 text-white font-bold py-2 px-4"
        >
            Créer une playlist
        </Link>
        </template>
    </MusicLayout>
</template>