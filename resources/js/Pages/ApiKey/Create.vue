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
      tracks: Array,
    },
    data() {
        return {
            // test: '',
            form: this.$inertia.form({
                name: '',
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(route('apiKeys.store'));
        }
    },

}

</script>

<template>
    <MusicLayout>
        <template #title>
           Créer une Api Key
        </template>
        <template #action>
            <Link 
            :href="route('apiKeys.index')" class="bg-blue-500 text-white font-bold py-2 px-4">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Titre
          </label>
          <input
              id="title"
              v-model="form.name"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{'border-red-500': form.errors.name}"
              type="text"
              placeholder="Name"
          >
          <p class="text-red-500 text-xs italic">{{ form.errors.name }}</p>
          {{ form }}
        </div>
        <input type="submit" value="Créer la clé" class="bg-blue-500 text-white font-bold py-2 px-4">
      </form>
        </template>
    </MusicLayout>
</template>