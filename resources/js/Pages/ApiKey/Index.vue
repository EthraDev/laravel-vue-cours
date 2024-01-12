<script>

import MusicLayout from '@/Layouts/MusicLayout.vue';
import {Link} from "@inertiajs/vue3";

export default {
    name: 'ApiKeyView',
    components: {
        MusicLayout,
        Link,
    },
    props: {
        playlists: Array,
    },
}

</script>

<template>
    <MusicLayout>
        <template #title>
            Clé d'API
            <Link
        :href="route('apiKeys.create')"
        class="bg-blue-500 text-white font-bold py-2 px-4"
        >
            Créer une clé
        </Link>
        </template>
        <template #content>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Nombre de musiques</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                    v-for="(playlist, i) in playlists"
                    :key="playlist.uuid"
                    >
                        <td>{{ i.id }}</td>
                        <td>{{ playlist.title }}</td>
                        <td>{{ playlist.tracks_count }}</td>
                        <td>{{ $moment(playlist.created_at).format('DD/MM/YYYY hh:mm:ss') }}</td>
                        <td>
                            <Link
                            :href="route('playlists.show',{ playlist: playlist})"
                            class="bg-blue-500 text-white font-bold py-2 px-4"
                            >
                                Voir
                            </Link>
                            <Link
                            :href="route('playlists.edit', playlist.uuid)"
                            class="bg-yellow-500 text-white font-bold py-2 px-4"
                            >
                                Modifier
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>