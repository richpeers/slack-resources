<template>
    <div class="col-md-4">
        <h3 class="text-primary">Tags</h3>
        <button v-for="item in tags"
                type="button"
                class="btn btn-outline-primary mr-2 mb-2"
                :class="{'active': item.id === tag}"
                @click.prevent="setTag(item.id)">
            {{item.body}}
        </button>
    </div>
</template>

<script>
    export default {
        name: "Tags",
        props: {
            tags: Array,
            tag: {
                required: true
            }
        },
        methods: {
            setTag(id) {
                this.$emit('set-tag', id);
            }
        }
    }
</script>

<style scoped>

</style>