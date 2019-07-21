<template>
    <div class="col-md-8">
        <h3 class="text-primary">Resources</h3>
        <div class="card-columns">

            <a v-for="resource in resources" class="card" :href="resource.url" target="_blank">

                <img v-if="resource.meta.image" :src="resource.meta.image" class="card-img-top" alt="resource.meta.image">

                <div class="card-body">
                    <h5 v-if="resource.meta.title" class="card-title">{{resource.meta.title}}</h5>
                    <p v-if="resource.meta.description" class="card-text">{{resource.meta.description}}</p>
                </div>
            </a>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Resources",
        props: {
            resources: Array
        }
    }
</script>
