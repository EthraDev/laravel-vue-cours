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
    props: {
        track: Object,
    },
    data() {
        return {
            // test: '',
            form: this.$inertia.form({
                title: this.track.title,
                artist: this.track.artist,
                display: this.track.display ? true : false,
            }),
        }
    },
    methods: {
        submit() {
            this.form.put(route('tracks.update', {track: this.track}));
        }
    },

}

</script>

<template>
    <MusicLayout>
        <template #title>
           Modifier la musique {{ track.title  }}
        </template>
        <template #action>
            <Link 
            :href="route('tracks.index')" class="bg-blue-500 text-white font-bold py-2 px-4">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Titre
          </label>
          <input
              id="title"
              v-model="form.title"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{'border-red-500': form.errors.title}"
              type="text"
              placeholder="Title"
          >
          <p class="text-red-500 text-xs italic">{{ form.errors.title }}</p>
        </div>
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="artist">
            Artiste
          </label>
          <input
              id="artiste"
              v-model="form.artist"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{'border-red-500': form.errors.artist}"
              type="text"
              placeholder="Artist"
          >
          <p class="text-red-500 text-xs italic">{{ form.errors.artiste }}</p>
        </div>
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="display">
            Afficher
          </label>
          <select
              id="display"
                v-model="form.display"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{'border-red-500': form.errors.display}"
              placeholder="Display"
            >
            <option :value="true">Oui</option>
            <option :value="false">Non</option>
          </select>
          <p class="text-red-500 text-xs italic">{{ form.errors.display }}</p>
        </div>
        <input type="submit" value="Créer la musique" class="bg-blue-500 text-white font-bold py-2 px-4">
      </form>
        </template>
    </MusicLayout>
</template>